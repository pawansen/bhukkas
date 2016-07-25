<?php

class ApiFunction extends DbExt {

    // get city list
    public $search_result_total;
    public $siteUrls;

    public function __construct() {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
        $this->siteUrls = $protocol . $_SERVER['HTTP_HOST'];
    }

    public function getCityList() {

        $option = array(
            'table' => '{{city}}',
            'select' => 'cid,city',
            'order' => array('city' => 'desc')
        );
        if ($rs = $this->customGet($option)):
            return $rs;
        else:
            return false;
        endif;
    }

    // get location list
    public function getLocationList() {

        $option = array(
            'table' => '{{location}}',
            'select' => 'lid,cityid,location',
            'order' => array('location' => 'desc')
        );
        if ($rs = $this->customGet($option)):
            return $rs;
        else:
            return false;
        endif;
    }

    public function getLocationByCity($city_id = '') {

        $option = array(
            'table' => '{{location}}',
            'select' => 'lid,cityid,location',
            'order' => array('location' => 'desc'),
            'where' => array('AND', 'cityid=' . $city_id)
        );
        if ($rs = $this->customGet($option)):
            return $rs;
        else:
            return false;
        endif;
    }

    public function getCuisineList() {

        $option = array(
            'table' => '{{cuisine}}',
            'select' => 'cuisine_id,cuisine_name',
            'order' => array('cuisine_name' => 'desc'),
            'where' => array('AND', 'status = 1')
        );
        if ($rs = $this->customGet($option)):
            return $rs;
        else:
            return false;
        endif;
    }

    public function clientUpdateAddress($data = array()) {
        $params = array(
            'client_id' => $data['client_id'],
            'street' => $data['street'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zipcode' => $data['zipcode'],
            'location_name' => isset($data['location_name']) ? $data['location_name'] : '',
            'as_default' => isset($data['as_default']) ? $data['as_default'] : 1,
            'date_created' => date('c'),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'country_code' => 'IN'
        );

        if ($data['as_default'] == 2) {
            $sql_up = "UPDATE {{address_book}}
     		SET as_default='1' 	     		
     		";
            $this->qry($sql_up);
        }

        if (isset($data['address_id'])) {
            unset($params['date_created']);
            $params['date_modified'] = date('c');
            if ($this->updateData("{{address_book}}", $params, 'id', $data['address_id'])) {
                return true;
            } else
                return false;
        } else {
            if ($this->insertData('{{address_book}}', $params)) {
                return true;
            } else
                return false;
        }
    }

    public function clientAddressList($client_id) {

        $option = array(
            'table' => '{{address_book}}',
            'select' => 'id,street,city,state,zipcode,location_name,as_default',
            'where' => array('AND', 'client_id =' . $client_id),
        );
        if ($rs = $this->customGet($option)):
            return $rs;
        else:
            return false;
        endif;
    }

    public function clientAuthRegistration($data = array()) {
        $response = array();

        if (!empty($data['contact_phone']) && !empty($data['email_address']) && !empty($data['password'])) {

            /* check if mobile number already exist */
            $functionk = new FunctionsK();
            if ($rs = $functionk->CheckCustomerMobile($data['contact_phone'])) {
                $response['msg'] = "Sorry but your mobile number is already exist in our records";
                $response['code'] = 0;
                return $response;
            }

            if ($res = Yii::app()->functions->isClientExist($data['email_address'])) {
                $response['msg'] = "Sorry but your email address already exist in our records";
                $response['code'] = 0;
                return $response;
            }
            $params = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email_address' => $data['email_address'],
                'password' => md5($data['password']),
                'date_created' => date('c'),
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'contact_phone' => $data['contact_phone'],
                'tnc' => $data['check_2'],
                'devicetoken' => $data['devicetoken']
            );
            if ($this->insertData("{{client}}", $params)) {
                FunctionsK::sendCustomerWelcomeEmail($data);
                $response['msg'] = "Your registration has completed successfully";
                $response['code'] = 1;
                return $response;
            } else {
                $response['msg'] = "Something went wrong during processing your request. Please try again later";
                $response['code'] = 0;
                return $response;
            }
        } else {
            $response['msg'] = "Something went wrong during processing your request. Please try again later";
            $response['code'] = 0;
            return $response;
        }
    }

    public function authLogin($data = array()) {
        $response = array();

        if (!empty($data['username']) && !empty($data['password']) && !empty($data['devicetype'])) {

            $rs = Yii::app()->functions->clientAutoLoginApi($data['username'], $data['password'], $data['devicetoken'],$data['devicetype']);
            
             

            if (!empty($rs)) {
                $response['code'] = 1;
                $response['msg'] = "Successfully logged In";
                $response['list'] = $rs;
                return $response;
            } else {
                $response['code'] = 0;
                $response['msg'] = "Login Failed. Either username or password is incorrect";
                return $response;
            }
        } else {
            $response['code'] = 0;
            $response['msg'] = "Login Failed. Either username or password is incorrect";
            return $response;
        }
    }

    public function authForgotPassword($email_address) {
        $response = array();

        if (!empty($email_address)) {
            $res = yii::app()->functions->isClientExist($email_address);
            if (!empty($res)) {

                $token = md5(date('c'));
                $params = array('lost_password_token' => $token);
                if ($this->updateData("{{client}}", $params, 'client_id', $res['client_id'])) {

                    //send email
                    $obj = new Widgets();
                    $tpl = $obj->emailTplForgotPassword($res, $token);
                    $sender = 'info@bhukkas.com';
                    $to = $email_address;
                    if (sendEmail($to, $sender, "Forgot Password", $tpl, 'forgot password')) {

                        $response['code'] = 1;
                        $response['msg'] = "We sent your forgot password link, Please follow that link. Thank You";
                        return $response;
                    } else {
                        $response['code'] = 0;
                        $response['msg'] = "Cannot sent email";
                        return $response;
                    }
                } else {
                    $response['code'] = 0;
                    $response['msg'] = "Cannot update records";
                    return $response;
                }
            } else {
                $response['code'] = 0;
                $response['msg'] = "Sorry but your Email address does not exist in our records";
                return $response;
            }
        } else {
            $response['code'] = 0;
            $response['msg'] = "Can not empty request email address";
            return $response;
        }
    }

    public function authUpdateProfile($data = array()) {
        $response = array();
        $functionk = new FunctionsK();
        if (!is_numeric($data['client_id'])) {
            $response['msg'] = "Your session has expired";
            $response['code'] = 0;
            return $response;
        }

        if ($r = $functionk->CheckCustomerMobileExists($data['contact_phone'], $data['client_id'])) {
            $response['msg'] = "Sorry but your mobile number is already exist in our records";
            $response['code'] = 0;
            return $response;
        }
        $params = array(
            'first_name' => isset($data['first_name']) ? $data['first_name'] : '',
            'last_name' => isset($data['last_name']) ? $data['last_name'] : '',
            'contact_phone' => isset($data['contact_phone']) ? $data['contact_phone'] : '',
            'date_modified' => date('c'),
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        if ($this->updateData("{{client}}", $params, 'client_id', $data['client_id'])) {

            $option = array(
                'table' => '{{client}}',
                'select' => 'client_id,first_name,last_name,email_address,contact_phone,date_created,last_login,status',
                'where' => array('AND', 'client_id=' . $data['client_id'])
            );
            $res = $this->customGet($option);

            $response['msg'] = "Your profile successfully updated";
            $response['code'] = 1;
            $response['list'] = $res[0];
            return $response;
        } else
            $response['msg'] = "Failed to update your profile";
        $response['code'] = 0;
        return $response;
    }

    public function authChangePassword($data = array()) {
        $response = array();
        $params = array(
            'date_modified' => date('c'),
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        if (isset($data['new_password'])) {
            if (!empty($data['new_password'])) {
                $params['password'] = md5($data['new_password']);
            }
        }
        $option = array(
            'table' => '{{client}}',
            'select' => 'password',
            'where' => array('AND', 'client_id=' . $data['client_id'], array('AND', "password='" . md5($data['old_password']) . "'"))
        );
        if (!$rs = $this->customGet($option)) {
            $response['msg'] = "Your new password cannot be accepted because the old password provided is not correct";
            $response['code'] = 0;
            return $response;
        } else {
            $option = array(
                'table' => '{{client}}',
                'data' => $params,
                'where' => array('AND', 'client_id=' . $data['client_id'])
            );
            if ($rs = $this->customUpdate($option)) {
                $response['msg'] = "your password has been changed successfully";
                $response['code'] = 1;
                return $response;
            } else {
                $response['msg'] = "Your password can not be change";
                $response['code'] = 0;
                return $response;
            }
        }
    }

    public function isMerchantFavourite($client_id, $merchant_id) {
        if (Yii::app()->functions->getFavoriteList($client_id, $merchant_id)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMerchantList($data = array()) {




        $response = array();
        $cuisine_list = Yii::app()->functions->Cuisine(true);
        $city = $data['cityName'];


        if (isset($data['offset']) && !empty($data['offset'])) {
            $Start_page = $data['offset'];
        } else {
            $Start_page = 0;
        }

        if (isset($data['limit']) && !empty($data['limit'])) {
            $per_page = $data['limit'];
        } else {
            $per_page = 10;
        }


        $and = "AND status='active' ";
        $and.="AND is_ready='2' ";
        // filter
        $sort_by = "distance ASC";
        $sort_by0 = " ORDER BY is_sponsored DESC";

        if (isset($data['filter_type']) && !empty($data['filter_type'])) {
            if ($data['filter_type'] == "minimum_order") {
                $sort_by = "CAST(" . $data['filter_type'] . " AS SIGNED ) ASC";
            } elseif ($data['filter_type'] == "ratings") {
                $sort_by = "CAST(" . $data['filter_type'] . " AS SIGNED ) DESC";
            } elseif ($data['filter_type'] == "delivery_charges") {
                $sort_by = "CAST(" . $data['filter_type'] . " AS SIGNED ) ASC";
            } else
                $sort_by = "restaurant_name ASC";
        }

        $sort_combine = "$sort_by0,$sort_by";

        if (isset($data['location']) && !empty($data['location'])) {
            $location = $data['location'];
            // $and.="AND street LIKE '%" . $location . "%'";
        }
        $address = $data['location'] . ' ' . $city;
        $latlang = Yii::app()->functions->geodecodeAddress($address);
        $lat = round($latlang['lat'], 6);
        $long = round($latlang['long'], 6);

        $radius = 10;
        if (isset($data['radius']) && is_numeric($data['radius']) && $data['radius'] > 10) {
            $radius = $data['radius'];
        }

        // filter by cuisine
        $filter_cuisine = '';
        if (isset($data['filter_cuisine']) && !empty($data['filter_cuisine'])) {
            $filter_cuisines = !empty($data['filter_cuisine']) ? explode(",", $data['filter_cuisine']) : false;
            if (is_array($filter_cuisines) && count($filter_cuisines) >= 1) {
                $x = 1;
                foreach ($filter_cuisines as $val) {
                    if (!empty($val)) {
                        if ($x == 1) {
                            $filter_cuisine.=" LIKE '%\"$val\"%'";
                        } else
                            $filter_cuisine.=" OR cuisine LIKE '%\"$val\"%'";
                        $x++;
                    }
                }
                if (!empty($filter_cuisine)) {
                    $and.=" AND (cuisine $filter_cuisine) ";
                }
            }
        }

        // filter by merchant name 
        $filter_names = '';
        if (isset($data['filter_search_name']) && !empty($data['filter_search_name'])) {
            $filter_names = $data['filter_search_name'];
            $and.=" AND restaurant_name LIKE '%$filter_names%' ";
        }

        // filter by category
        $categorys = "";
        if (isset($data['category']) && !empty($data['category'])) {
            $categorys = $data['category'];
            if (!empty($categorys) && $categorys != 'all') {
                $and.=" AND merchant_category = '" . $categorys . "'   ";
            }
        }


        $client_id = 0;
        if (isset($data['client_id']) && !empty($data['client_id'])) {
            $client_id = $data['client_id'];
        }

        $stmt = " SELECT SQL_CALC_FOUND_ROWS a.merchant_id,a.restaurant_slug,a.restaurant_name,a.restaurant_phone,
                   a.service,a.free_delivery,a.merchant_category,a.latitude,a.lontitude,a.cuisine,
                   a.delivery_charges,a.minimum_order,a.ratings ,(
                   6371 * acos( cos( radians(  $lat ) ) * cos( radians( a.latitude ) ) * cos( radians( a.lontitude ) - radians( $long  ) ) + sin( radians(  $lat  ) ) * sin( radians( a.latitude ) ) )
                   ) AS distance 
                    FROM {{view_merchant}} a 
                    WHERE city LIKE '" . $city . "%'
                    $and  HAVING distance <= $radius 
                    $sort_combine
                    LIMIT $Start_page,$per_page
                    ";
        $stmt2 = "SELECT FOUND_ROWS()";
        $count_query = true;

        




        $result = array();
        if ($res = $this->rst($stmt)) {

            $this->search_result_total = 0;
            if ($res_total = $this->rst($stmt2)) {

                if ($count_query == true) {
                    $this->search_result_total = $res_total[0]['FOUND_ROWS()'];
                } else
                    $this->search_result_total = $res_total[0]['total_records'];
            }

            foreach ($res as $rows):

                $temp = array();

                $resto_cuisine = "";
                $cuisine = !empty($rows['cuisine']) ? (array) json_decode($rows['cuisine']) : false;
                if ($cuisine != false) {
                    foreach ($cuisine as $valc) {
                        if (array_key_exists($valc, (array) $cuisine_list)) {
                            $resto_cuisine.=$cuisine_list[$valc] . " / ";
                        }
                    }
                    $resto_cuisine = !empty($resto_cuisine) ? substr($resto_cuisine, 0, -2) : 0;
                }
                $merchant_photo = Yii::app()->functions->getOption("merchant_photo", $rows['merchant_id']);


                if (!empty($merchant_photo)) {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/upload/" . $merchant_photo;
                } else {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/assets/images/100X100.png";
                }


                $delivery_fee = $rows['delivery_charges'];
                if (is_numeric($delivery_fee) && $delivery_fee >= 1) {
                    $fee = $delivery_fee;
                } else {
                    $fee = "Free Delivery";
                }
                $delivery_est = Yii::app()->functions->getOption("merchant_delivery_estimation", $rows['merchant_id']);
                $mt_delivery_miles = Yii::app()->functions->getOption("merchant_delivery_miles", $rows['merchant_id']);
                if (is_numeric($mt_delivery_miles)) {
                    $mt_delivery_miles = $mt_delivery_miles;
                } else {
                    $mt_delivery_miles = 0;
                }

                $validOffer = 0;
                if ($offer = Yii::app()->functions->getMerchantOffersActive($rows['merchant_id'])) {
                    $validOffer = number_format($offer['offer_percentage'], 0) . '%';
                }
                
                $open = "Closed";
                $is_merchant_open = Yii::app()->functions->isMerchantOpen($rows['merchant_id']);
                if ($is_merchant_open == TRUE) {
                    $open = "Open";
                }

                $temp['merchant_id'] = $rows['merchant_id'];
                $temp['restaurant_slug'] = $rows['restaurant_slug'];
                $temp['restaurant_name'] = $rows['restaurant_name'];
                $temp['restaurant_phone'] = isset($rows['restaurant_phone']) ? $rows['restaurant_phone'] : 0;
                $temp['free_delivery'] = (isset($rows['free_delivery'])) ? $rows['free_delivery'] : 0;
                $temp['merchant_category'] = (isset($rows['merchant_category'])) ? $rows['merchant_category'] : 0;
                $temp['latitude'] = (isset($rows['latitude'])) ? $rows['latitude'] : 0;
                $temp['lontitude'] = (isset($rows['lontitude'])) ? $rows['lontitude'] : 0;
                $temp['delivery_charges'] = $fee;
                $temp['minimum_order'] = (isset($rows['minimum_order'])) ? $rows['minimum_order'] : 0;
                $temp['ratings'] = (isset($rows['ratings'])) ? $rows['ratings'] : 0;
                $temp['cuisine'] = $resto_cuisine;
                $temp['merchant_photo'] = $photo_url;
                $temp['delivery_estimation_time'] = ($delivery_est) ? $delivery_est : 0;
                $temp['delivery_in'] = $mt_delivery_miles;
                $temp['offer'] = $validOffer;
                $temp['distance'] = number_format((float) $rows['distance'], 1, '.', '');
                $temp['isfavourite'] = ($client_id) ? ($this->isMerchantFavourite($client_id, $rows['merchant_id'])) ? 1 : 0 : 0;
                $temp['is_open'] = $open;

                $result [] = $temp;
            endforeach;

            $response['msg'] = $this->search_result_total . " results in your zone";
            $response['code'] = 1;
            $response['total_rows'] = $this->search_result_total;
            $response['list'] = $result;
            return $response;
        } else {
            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
            return $response;
        }
    }

    public function getMerchantByCity($cityName) {
        $response = array();
        $stmt = " SELECT restaurant_name  
                    FROM {{view_merchant}}
                    WHERE city LIKE '" . $cityName . "%'
                    ";
        if ($res = $this->rst($stmt)) {
            $response['msg'] = "Successfully";
            $response['code'] = 1;
            $response['list'] = $res;
            return $response;
        } else {

            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
            return $response;
        }
    }

    public function addFavourite($data = array()) {
        $response = array();
        $params = array(
            'merchant_id' => $data['merchant_id'],
            'client_id' => $data['client_id'],
            'date_created' => date('c')
        );

        if (Yii::app()->functions->getFavoriteList($data['client_id'], $data['merchant_id'])) {
            $response['msg'] = "already added in your favorite list";
            $response['code'] = 0;
            return $response;
        } else {
            if ($this->insertData("{{favourite}}", $params)) {
                $response['msg'] = "Successfully added in your favorite list";
                $response['code'] = 1;
                return $response;
            } else {
                $response['msg'] = "Failed to added in your favorite list";
                $response['code'] = 0;
                return $response;
            }
        }
    }

    public function removeFavourite($data = array()) {
        $response = array();
        $merchant_id = $data['merchant_id'];
        $client_id = $data['client_id'];
        $sql = "DELETE FROM {{favourite}} WHERE merchant_id = '$merchant_id' AND client_id = '$client_id' ";
        if ($this->qry($sql)) {
            $response['msg'] = "Successfully remove in your favorite list";
            $response['code'] = 1;
            return $response;
        } else {
            $response['msg'] = "Failed to remove in your favorite list";
            $response['code'] = 0;
            return $response;
        }
    }

    public function getFavouriteList($data = array()) {
        $response = array();
        $client_id = $data['client_id'];
        if (isset($data['offset']) && !empty($data['offset'])) {
            $Start_page = $data['offset'];
        } else {
            $Start_page = 0;
        }
        if (isset($data['limit']) && !empty($data['limit'])) {
            $per_page = $data['limit'];
        } else {
            $per_page = 10;
        }
        $cuisine_list = Yii::app()->functions->Cuisine(true);
        $stmt = "SELECT c.*,a.fav_id
	    	       FROM
	    	       {{favourite}} a
	    	       left join {{client}} b
	    	       ON
	    	       a.client_id=b.client_id
                       left join {{view_merchant}} c
	    	       ON
	    	       a.merchant_id=c.merchant_id
	    	       WHERE
	    	       a.client_id = $client_id LIMIT $Start_page,$per_page";

        $result = array();
        if ($res = $this->rst($stmt)) {
            foreach ($res as $rows):
                $temp = array();

                $resto_cuisine = "";
                $cuisine = !empty($rows['cuisine']) ? (array) json_decode($rows['cuisine']) : false;
                if ($cuisine != false) {
                    foreach ($cuisine as $valc) {
                        if (array_key_exists($valc, (array) $cuisine_list)) {
                            $resto_cuisine.=$cuisine_list[$valc] . " / ";
                        }
                    }
                    $resto_cuisine = !empty($resto_cuisine) ? substr($resto_cuisine, 0, -2) : 0;
                }
                $merchant_photo = Yii::app()->functions->getOption("merchant_photo", $rows['merchant_id']);
                if (!empty($merchant_photo)) {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/upload/" . $merchant_photo;
                } else {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/assets/images/100X100.png";
                }


                $delivery_fee = $rows['delivery_charges'];
                if (is_numeric($delivery_fee) && $delivery_fee >= 1) {
                    $fee = $delivery_fee;
                } else {
                    $fee = "Free Delivery";
                }
                $delivery_est = Yii::app()->functions->getOption("merchant_delivery_estimation", $rows['merchant_id']);
                $mt_delivery_miles = Yii::app()->functions->getOption("merchant_delivery_miles", $rows['merchant_id']);
                if (is_numeric($mt_delivery_miles)) {
                    $mt_delivery_miles = $mt_delivery_miles;
                } else {
                    $mt_delivery_miles = 0;
                }

                $validOffer = 0;
                if ($offer = Yii::app()->functions->getMerchantOffersActive($rows['merchant_id'])) {
                    $validOffer = number_format($offer['offer_percentage'], 0) . '%';
                }
                
                $open = "Closed";
                $is_merchant_open = Yii::app()->functions->isMerchantOpen($rows['merchant_id']);
                if ($is_merchant_open == TRUE) {
                    $open = "Open";
                }

                $temp['merchant_id'] = $rows['merchant_id'];
                $temp['restaurant_slug'] = $rows['restaurant_slug'];
                $temp['restaurant_name'] = $rows['restaurant_name'];
                $temp['restaurant_phone'] = isset($rows['restaurant_phone']) ? $rows['restaurant_phone'] : 0;
                $temp['free_delivery'] = (isset($rows['free_delivery'])) ? $rows['free_delivery'] : 0;
                $temp['merchant_category'] = (isset($rows['merchant_category'])) ? $rows['merchant_category'] : 0;
                $temp['latitude'] = (isset($rows['latitude'])) ? $rows['latitude'] : 0;
                $temp['lontitude'] = (isset($rows['lontitude'])) ? $rows['lontitude'] : 0;
                $temp['delivery_charges'] = $fee;
                $temp['minimum_order'] = (isset($rows['minimum_order'])) ? $rows['minimum_order'] : 0;
                $temp['ratings'] = (isset($rows['ratings'])) ? $rows['ratings'] : 0;
                $temp['cuisine'] = $resto_cuisine;
                $temp['merchant_photo'] = $photo_url;
                $temp['delivery_estimation_time'] = ($delivery_est) ? $delivery_est : 0;
                $temp['delivery_in'] = $mt_delivery_miles;
                $temp['offer'] = $validOffer;
                //$temp['distance'] = number_format((float) $rows['distance'], 1, '.', '');
                $temp['isfavourite'] = ($client_id) ? ($this->isMerchantFavourite($client_id, $rows['merchant_id'])) ? 1 : 0 : 0;
                $temp['is_open'] = $open;
                $temp['fav_id'] = $rows['fav_id'];

                $result [] = $temp;
            endforeach;

            $response['msg'] = "Successfully found favourite list";
            $response['code'] = 1;
            $response['list'] = $result;
            return $response;
        } else {
            $response['msg'] = "Sorry but we cannot find what you are favourite list";
            $response['code'] = 0;
            return $response;
        }
    }

    public function calculateDistance($origin = '', $designation = '') {

        if (stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true) {
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=22.7538815,75.89658&destinations=22.7294,75.8832";
        } else {
            $url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=22.7538815,75.89658&destinations=22.7294,75.8832";
        }
        $data = @file_get_contents($url);
        if (empty($data)) {
            $data = $this->Curl($url);
        }
        $data = json_decode($data);
        if ($data->status == "OK") {
            if ($data->rows[0]->elements[0]->status == "OK") {
                echo $data;
            }
        }
    }

    public function merchantMenuList($merchant_id) {
        $rs = array();
        if (!empty($merchant_id)) {
            $stmt = "
		SELECT cat_id,category_name FROM
		{{category}}
		WHERE 
		merchant_id='" . $merchant_id . "'
		AND status in ('publish','published')
		ORDER BY sequence ASC
		";
            $connection = Yii::app()->db;
            $rows = $connection->createCommand($stmt)->queryAll();
            if (is_array($rows) && count($rows) >= 1) {
                return $rows;
            } else {
                return $rs;
            }
        } else {
            return $rs;
        }
    }

    public function getDetailMerchant($data = array()) {
        $response = array();
        $merchant_id = $data['merchant_id'];

        $lat = ($data['latitude']) ? $data['latitude'] : 0;
        $long = ($data['lontitude']) ? $data['lontitude'] : 0;

        $stmt = " SELECT SQL_CALC_FOUND_ROWS a.merchant_id,a.restaurant_slug,a.restaurant_name,a.restaurant_phone,
                   a.service,a.free_delivery,a.merchant_category,a.latitude,a.lontitude,a.cuisine,
                   a.delivery_charges,a.minimum_order,a.ratings,a.is_sponsored,(
                   6371 * acos( cos( radians(  $lat ) ) * cos( radians( a.latitude ) ) * cos( radians( a.lontitude ) - radians( $long  ) ) + sin( radians(  $lat  ) ) * sin( radians( a.latitude ) ) )
                   ) AS distance,CONCAT(street,' ',city,' ',state,' ',post_code) as address
                    FROM {{view_merchant}} a 
                    WHERE merchant_id = $merchant_id
                    ";
        if ($res = $this->rst($stmt)) {

            foreach ($res as $rows):

                $temp = array();

                $resto_cuisine = "";
                $cuisine = !empty($rows['cuisine']) ? (array) json_decode($rows['cuisine']) : false;
                if ($cuisine != false) {
                    foreach ($cuisine as $valc) {
                        if (array_key_exists($valc, (array) $cuisine_list)) {
                            $resto_cuisine.=$cuisine_list[$valc] . " / ";
                        }
                    }
                    $resto_cuisine = !empty($resto_cuisine) ? substr($resto_cuisine, 0, -2) : 0;
                }

                $merchant_photo = Yii::app()->functions->getOption("merchant_photo", $rows['merchant_id']);
                if (!empty($merchant_photo)) {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/upload/" . $merchant_photo;
                } else {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/assets/images/100X100.png";
                }


                $delivery_fee = $rows['delivery_charges'];
                if (is_numeric($delivery_fee) && $delivery_fee >= 1) {
                    $fee = $delivery_fee;
                } else {
                    $fee = "Free Delivery";
                }

                $delivery_est = Yii::app()->functions->getOption("merchant_delivery_estimation", $rows['merchant_id']);
                $mt_delivery_miles = Yii::app()->functions->getOption("merchant_delivery_miles", $rows['merchant_id']);
                if (is_numeric($mt_delivery_miles)) {
                    $mt_delivery_miles = $mt_delivery_miles;
                } else {
                    $mt_delivery_miles = 0;
                }

                $validOffer = 0;
                if ($offer = Yii::app()->functions->getMerchantOffersActive($rows['merchant_id'])) {
                    $validOffer = number_format($offer['offer_percentage'], 0) . '%';
                }
                $open = "Closed";
                $is_merchant_open = Yii::app()->functions->isMerchantOpen($rows['merchant_id']);
                if ($is_merchant_open == TRUE) {
                    $open = "Open";
                }

                $free_delivery_on = 0;
                $price_above = Yii::app()->functions->getOption("free_delivery_above_price", $rows['merchant_id']);
                if (is_numeric($price_above) && $price_above >= 1) {
                    $free_delivery_on = $price_above;
                }

                $merchantHours = Yii::app()->functions->getMerchantBusinnesHours($rows['merchant_id']);

                $about = Yii::app()->functions->getOption("merchant_information", $rows['merchant_id']);

                $menu = $this->merchantMenuList($rows['merchant_id']);

                $temp['merchant_id'] = $rows['merchant_id'];
                $temp['restaurant_slug'] = $rows['restaurant_slug'];
                $temp['restaurant_name'] = $rows['restaurant_name'];
                $temp['restaurant_phone'] = isset($rows['restaurant_phone']) ? $rows['restaurant_phone'] : 0;
                $temp['free_delivery'] = (isset($rows['free_delivery'])) ? $rows['free_delivery'] : 0;
                $temp['merchant_category'] = (isset($rows['merchant_category'])) ? $rows['merchant_category'] : 0;
                $temp['latitude'] = (isset($rows['latitude'])) ? $rows['latitude'] : 0;
                $temp['lontitude'] = (isset($rows['lontitude'])) ? $rows['lontitude'] : 0;
                $temp['delivery_charges'] = $fee;
                $temp['minimum_order'] = (isset($rows['minimum_order'])) ? $rows['minimum_order'] : 0;
                $temp['ratings'] = (isset($rows['ratings'])) ? $rows['ratings'] : 0;
                $temp['cuisine'] = $resto_cuisine;
                $temp['merchant_photo'] = $photo_url;
                $temp['delivery_estimation_time'] = ($delivery_est) ? $delivery_est : 0;
                $temp['delivery_in'] = $mt_delivery_miles;
                $temp['offer'] = $validOffer;
                $temp['is_sponsored'] = ($rows['is_sponsored'] == 2) ? "sponsored" : 0;
                $temp['is_open'] = $open;
                $temp['distance'] = (isset($rows['distance']) && $lat > 1) ? number_format((float) $rows['distance'], 1, '.', '') : 0;
                $temp['address'] = (isset($rows['address'])) ? $rows['address'] : 0;
                $temp['free_delivery_on'] = $free_delivery_on;
                $temp['about'] = ($about) ? str_replace("&nbsp;", " ", strip_tags($about)) : 0;

                $response['work_hours'] = $merchantHours;
                $response['menu'] = $menu;
                $result [] = $temp;
            endforeach;

            $response['msg'] = $this->search_result_total . " results in your zone";
            $response['code'] = 1;
            $response['total_rows'] = $this->search_result_total;
            $response['list'] = $result;
            return $response;
        } else {

            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
            return $response;
        }
    }

    public function getMerchantReviewList($data = array()) {
        $response = array();
        $merchant_id = $data['merchant_id'];
        $stmt = "SELECT a.id,a.client_id,a.review,a.rating,a.date_created,
            (SELECT CONCAT(first_name,' ',last_name) from  {{client}} WHERE client_id = a.client_id) as name
             FROM
		{{review}} a
		WHERE
		merchant_id='$merchant_id'
		AND
		status ='publish'
		";
        if ($reviews = $this->rst($stmt)) {
            $response['msg'] = "records found";
            $response['code'] = 1;
            $response['list'] = $reviews;
            return $response;
        } else {
            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
            return $response;
        }
    }

    public function clientLeaveReview($data = array()) {
        $response = array();
        if (empty($data['review_content'])) {
            $response['msg'] = "review content required";
            $response['code'] = 0;
        } else if (empty($data['rating'])) {
            $response['msg'] = "rating required";
            $response['code'] = 0;
        } else if (!is_numeric($data['rating'])) {
            $response['msg'] = "rating accept only numeric";
            $response['code'] = 0;
        } else {

            $option = array(
                'table' => "{{review}}",
                'select' => 'id',
                'where' => array('AND', 'merchant_id=' . $data['merchant_id'], array('AND', 'client_id=' . $data['client_id']))
            );
            if ($this->customGet($option)) {
                $response['msg'] = "reviews already reviewed on this merchant";
                $response['code'] = 0;
            } else {

                $params = array(
                    'merchant_id' => $data['merchant_id'],
                    'client_id' => $data['client_id'],
                    'review' => $data['review_content'],
                    'date_created' => date('c'),
                    'rating' => $data['rating']
                );

                if ($this->insertData("{{review}}", $params)) {
                    $response['msg'] = "Your review has been published";
                    $response['code'] = 1;
                } else {
                    $response['msg'] = "cannot insert records";
                    $response['code'] = 0;
                }
            }
        }

        return $response;
    }

    public function clientUpdateReview($data = array()) {
        $response = array();
        if (empty($data['review_content'])) {
            $response['msg'] = "review content required";
            $response['code'] = 0;
        } else if (empty($data['rating'])) {
            $response['msg'] = "rating required";
            $response['code'] = 0;
        } else if (!is_numeric($data['rating'])) {
            $response['msg'] = "rating accept only numeric";
            $response['code'] = 0;
        } else {

            $params = array(
                'review' => $data['review_content'],
                'date_created' => date('c'),
                'rating' => $data['rating']
            );

            $option = array(
                'table' => "{{review}}",
                'data' => $params,
                'where' => array('AND', 'id=' . $data['review_id'], array('AND', 'client_id=' . $data['client_id']))
            );
            if ($this->customUpdate($option)) {
                $response['msg'] = "Your review has been successfully update";
                $response['code'] = 1;
            } else {

                $response['msg'] = "cannot update records";
                $response['code'] = 0;
            }
        }

        return $response;
    }

    public function getClientReviewList($data = array()) {
        $response = array();

        $stmt = "SELECT a.id,a.merchant_id,a.client_id,a.review,a.rating,a.date_created,
                 (SELECT restaurant_name from  {{merchant}} WHERE merchant_id = a.merchant_id) as merchant_name
                  FROM
		{{review}} a
		WHERE
		client_id='" . $data['client_id'] . "'
		AND
		status ='publish'
		";
        if ($rs = $this->rst($stmt)) {
            $response['msg'] = "Your review records found";
            $response['code'] = 1;
            $response['list'] = $rs;
        } else {

            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
        }
        return $response;
    }

    public function getCms($data = array()) {
        $response = array();
        $where = "";
        switch ($data['cms_type']):

            case "about":
                $where = "about_us";
                break;
            case "tac":
                $where = "terms_and_conditions";
                break;
            default:
                $where = "";

        endswitch;

        $option = array(
            'table' => "{{cms}}",
            'select' => 'title,description',
            'where' => array('AND', "cms_code='" . $where . "'")
        );
        if ($rs = $this->customGet($option)) {
            $response['msg'] = "records found";
            $response['code'] = 1;
            $response['list'] = $rs;
        } else {
            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
        }

        return $response;
    }

    public function userContactAdmin($data = array()) {
        $response = array();

        if (empty($data['name'])) {
            $response['msg'] = "name is required";
            $response['code'] = 0;
            return $response;
        } 

        /*else if (empty($data['email'])) {
            $response['msg'] = "email is required";
            $response['code'] = 0;
            return $response;

        } */

        else if (empty($data['phone'])) {
            $response['msg'] = "phone is required";
            $response['code'] = 0;
            return $response;
        } else if (empty($data['message'])) {
            $response['msg'] = "message is required";
            $response['code'] = 0;
            return $response;
        } else {

            $subject = "New Contact Us";
            $to = yii::app()->functions->getOptionAdmin('contact_email_receiver');
            $from = 'info@bhukkas.com';
            if (empty($to)) {
                $response['msg'] = "receiver email address not valid";
                $response['code'] = 0;
                return $response;
            }
            $params = array(
                'contact_name' => $data['name'],
                'contact_email' => $data['email'],
                'contact_phone' => $data['phone'],
                'contact_country' => $data['country'],
                'contact_message' => $data['message']
            );
            $obj = new Widgets();
            $tpl = $obj->emailTemplatesContact($data);
            $title = "Bhukkas";
            if ($this->insertData("{{contact_us}}", $params)) {

                if (sendEmail($to, $from, $subject, $tpl, $title)) {
                    $response['msg'] = "Your message was sent successfully. Thanks";
                    $response['code'] = 1;
                    return $response;
                } else
                    $response['msg'] = "Cannot sent email";
                $response['code'] = 0;
                return $response;
            } else
                $response['msg'] = "Cannot sent email";
            $response['code'] = 0;
            return $response;
        }
    }

    public function getMerchantMenuDishes($data = array()) {
        $response = array();

        $res = Yii::app()->functions->getItemByCategoryDishes($data['cat_id'], false, $data['merchant_id']);
        if (!empty($res)) {
            $response['msg'] = "records found";
            $response['code'] = 1;
            $response['list'] = $res;
        } else {
            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
        }
        return $response;
    }

    public function getVoucherCodeByMerchant($voucher_code = '', $merchant_id = '', $client_id = '') {

        $stmt = "
                    SELECT a.*,
                    (
                    select count(*) from
                    {{order}}
                    where
                    voucher_code=" . Yii::app()->functions->q($voucher_code) . "
                    and
                    client_id=" . Yii::app()->functions->q($client_id) . "  	
                    LIMIT 0,1
                    ) as found,

                    (
                    select count(*) from
                    {{order}}
                    where
                    voucher_code=" . Yii::app()->functions->q($voucher_code) . "    	
                    LIMIT 0,1
                    ) as number_used    

                    FROM
                    {{voucher_new}} a
                    WHERE
                    voucher_name=" . Yii::app()->functions->q($voucher_code) . "
                    AND
                    merchant_id=" . Yii::app()->functions->q($merchant_id) . "
                    AND status IN ('publish','published')
                    LIMIT 0,1
                    ";
        if ($res = $this->rst($stmt)) {
            return $res[0];
        }
        return false;
    }

    public function getVoucherCodeByAdmin($voucher_code = '', $client_id = '') {
        $db_ext = new DbExt;
        $stmt = "
                    SELECT a.*,
                    (
                    select count(*) from
                    {{order}}
                    where
                    voucher_code=" . Yii::app()->functions->q($voucher_code) . "
                    and
                    client_id=" . Yii::app()->functions->q($client_id) . "  	
                    LIMIT 0,1
                    ) as found,

                    (
                    select count(*) from
                    {{order}}
                    where
                    voucher_code=" . Yii::app()->functions->q($voucher_code) . "    	
                    LIMIT 0,1
                    ) as number_used    	

                    FROM
                    {{voucher_new}} a
                    WHERE
                    voucher_name=" . Yii::app()->functions->q($voucher_code) . "
                    AND
                    voucher_owner='admin'
                    AND status IN ('publish','published')
                    LIMIT 0,1
                    ";
        if ($res = $db_ext->rst($stmt)) {
            return $res[0];
        }
        return false;
    }

    public function applyVoucherCode($data = array()) {
        $response = array();
        $merchant_id = $data['merchant_id'];
        $voucher_code = $data['voucher_code'];
        $client_id = $data['client_id'];
        if ($res = $this->getVoucherCodeByMerchant($voucher_code, $merchant_id, $client_id)) {

            if ($res['used_once'] == 2) {
                if ($res['number_used'] > 0) {
                    $response['msg'] = "Sorry this voucher code has already been used";
                    $response['code'] = 0;
                    return $response;
                }
            }

            if (!empty($res['expiration'])) {
                $expiration = $res['expiration'];
                $now = date('Y-m-d');
                $date_diff = date_diff(date_create($now), date_create($expiration));
                if (is_object($date_diff)) {
                    if ($date_diff->invert == 1) {
                        if ($date_diff->d > 0) {
                            $response['msg'] = "Voucher code has expired";
                            $response['code'] = 0;
                            return $response;
                        }
                    }
                }
            }

            if ($res['found'] <= 0) {
                $response['code'] = 1;
                $response['msg'] = "voucher found";
                $response['list'] = $res;
                return $response;
            } else
                $response['code'] = 0;
            $response['msg'] = "Sorry but you have already use this voucher code";
            return $response;
        }else {

            if ($res = $this->getVoucherCodeByAdmin($voucher_code, $client_id)) {

                if (!empty($res['expiration'])) {
                    $expiration = $res['expiration'];
                    $now = date('Y-m-d');
                    $date_diff = date_diff(date_create($now), date_create($expiration));
                    if (is_object($date_diff)) {
                        if ($date_diff->invert == 1) {
                            if ($date_diff->d > 0) {
                                $response['msg'] = "Voucher code has expired";
                                $response['code'] = 0;
                                return $response;
                            }
                        }
                    }
                }

                if ($res['used_once'] == 2) {
                    if ($res['number_used'] > 0) {
                        $response['msg'] = "Sorry this voucher code has already been used";
                        $response['code'] = 0;
                        return $response;
                    }
                }

                if (!empty($res['joining_merchant'])) {
                    $joining_merchant = json_decode($res['joining_merchant']);
                    if (in_array($merchant_id, (array) $joining_merchant)) {
                        
                    } else {
                        $response['msg'] = "Sorry this voucher code cannot be used on this merchant";
                        $response['code'] = 0;
                        return $response;
                    }
                }

                if ($res['found'] <= 0) {
                    $response['code'] = 1;
                    $response['msg'] = "voucher found";
                    $response['list'] = $res;
                    return $response;
                } else
                    $response['code'] = 0;
                $response['msg'] = "Sorry but you have already use this voucher code";
                return $response;
            }else {
                $response['msg'] = "Voucher code not found";
                $response['code'] = 0;
                return $response;
            }
        }
    }

    public function clientOrderList($data = array()) {
        $response = array();
        $offset = (isset($data['offset'])) ? $data['offset'] : 0;
        $limit = (isset($data['limit'])) ? $data['limit'] : 10;
        $client_id = $data['client_id'];
        $stmt = "
                SELECT a.order_id,a.merchant_id,a.payment_type,a.status,a.date_created,a.total_w_tax,
                (
                select restaurant_name
                from
                {{merchant}}
                where
                merchant_id=a.merchant_id
                ) as merchant_name
                 FROM
                {{order}} a
                WHERE 
                client_id='$client_id'
                
                ORDER BY order_id DESC
                LIMIT $offset,$limit
                ";
        $result = array();
        if ($res = $this->rst($stmt)):
            
           
            foreach($res as $rows){
                $temp = array();
                
                $merchant_photo = Yii::app()->functions->getOption("merchant_photo", $rows['merchant_id']);
                if (!empty($merchant_photo)) {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/upload/" . $merchant_photo;
                } else {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/assets/images/100X100.png";
                }
                
                 $temp['order_id'] = isset($rows['order_id']) ? $rows['order_id'] : 0;
                 $temp['merchant_id'] = isset($rows['merchant_id']) ? $rows['merchant_id'] : 0;
                 $temp['payment_type'] = isset($rows['payment_type']) ? $rows['payment_type'] : 0;
                 $temp['status'] = isset($rows['status']) ? $rows['status'] : 0;
                 $temp['date_created'] = isset($rows['date_created']) ? $rows['date_created'] : 0;
                 $temp['merchant_name'] = isset($rows['merchant_name']) ? $rows['merchant_name'] : 0;
                 $temp['merchant_photo'] = isset($photo_url) ? $photo_url : 0;
                 $temp['totel_cost'] = isset($rows['total_w_tax']) ?  number_format((float) $rows['total_w_tax'], 1, '.', '') : 0;
                 $result[] = $temp;
            }
            $response['code'] = 1;
            $response['msg'] = "records found";
            $response['list'] = $result;
            return $response;
        else:

            $response['msg'] = "records not found";
            $response['code'] = 0;
            return $response;
        endif;
    }

    public function clientAddressRemove($data = array()) {
        $response = array();
        $client_id = $data['client_id'];
        $address_id = $data['address_id'];
        $option = array(
            'table' => '{{address_book}}',
            'where' => array('AND', 'client_id =' . $client_id, array('AND', 'id =' . $address_id)),
        );
        if ($rs = $this->customDelete($option)):
            $response['code'] = 1;
            $response['msg'] = "Successfully removed your address";
            return $response;
        else:

            $response['msg'] = "Failed to remove your address";
            $response['code'] = 0;
            return $response;
        endif;
    }

    public function getPaymentType($data = array()) {
        $response = array();
        $payment = array();
        $is_commision = false;
        if (Yii::app()->functions->isMerchantCommission($data['merchant_id'])) {
            $is_commision = true;
        }

        $paymentgateway = Yii::app()->functions->getMerchantListOfPaymentGateway();
        $merchant_disabled_cod = Yii::app()->functions->getOption('merchant_disabled_cod', $data['merchant_id']);
        if (!in_array("cod", (array) $paymentgateway)) {
            $merchant_disabled_cod = "yes";
        }

        $merchant_payu_enabled = Yii::app()->functions->getOption('merchant_payu_enabled', $data['merchant_id']);
        $merchant_payu_enabled = $merchant_payu_enabled == "yes" ? true : false;
        if ($merchant_payu_enabled == true) {
            $merchant_payu_enabled = in_array("payu", (array) $paymentgateway) ? true : false;
        }

        $merchant_ccAvenue_enabled = Yii::app()->functions->getOption('merchant_ccAvenue_enabled', $data['merchant_id']);
        $merchant_ccAvenue_enabled = $merchant_ccAvenue_enabled == "yes" ? true : false;
        if ($merchant_ccAvenue_enabled == true) {
            $merchant_ccAvenue_enabled = in_array("cca", (array) $paymentgateway) ? true : false;
        }
        /* IF MERCHANT COMMISION */
        if ($is_commision) {
            $merchant_payu_enabled = in_array("payu", (array) $paymentgateway) ? true : false;
            $merchant_ccAvenue_enabled = in_array("cca", (array) $paymentgateway) ? true : false;
        }

        $merchant_switch_master_cod = Yii::app()->functions->getOption("merchant_switch_master_cod", $data['merchant_id']);
        if ($merchant_switch_master_cod == 2) {
            $merchant_disabled_cod = "yes";
        }

        if ($merchant_disabled_cod != "yes"):
            $payment[] = 'cod';
        endif;
        if ($merchant_payu_enabled == TRUE):
            $payment[] = 'payu';
        endif;
        if ($merchant_ccAvenue_enabled == TRUE):
            $payment[] = 'cca';
        endif;

        if (is_array($payment) && !empty($payment)):
            $response['msg'] = "payment found";
            $response['code'] = 1;
            $response['list'] = $payment;
            return $response;
        else:
            $response['msg'] = "we are not found any type of payment";
            $response['code'] = 0;
            return $response;
        endif;
    }

    /**
     * 
     * @param delivery_time,delivery_date,merchant_id,delivery_type['delivery']
     * 
     */
    public function validDeliveryOptDateTime($data = array()) {

        if (empty($data['delivery_time'])) {

            $data['msg'] = "delivery time is required";
            return $data;
        } elseif (empty($data['delivery_date'])) {

            $data['msg'] = "delivery date is required";
            return $data;
        }

        /** check if time is non 24 hour format */
        if (yii::app()->functions->getOptionAdmin('website_time_picker_format') == "12") {
            if (!empty($data['delivery_time'])) {
                $data['delivery_time'] = date("G:i", strtotime($data['delivery_time']));
            }
        }

        if (!empty($data['delivery_date'])) {
            $data['delivery_date'] = date("Y-m-d", strtotime($data['delivery_date']));
        }

        /** check if customer chooose past time */
        if (isset($data['delivery_time'])) {
            if (!empty($data['delivery_time'])) {
                $time_1 = date('Y-m-d g:i:s a');
                $time_2 = $data['delivery_date'] . " " . $data['delivery_time'];
                $time_2 = date("Y-m-d g:i:s a", strtotime($time_2));
                $time_diff = Yii::app()->functions->dateDifference($time_2, $time_1);
                if (is_array($time_diff) && count($time_diff) >= 1) {
                    if ($time_diff['hours'] > 0) {
                        $data['msg'] = "Sorry but you have selected time that already past";
                        return $data;
                    }
                }
            }
        }

        $time = isset($data['delivery_time']) ? $data['delivery_time'] : '';
        $full_booking_time = $data['delivery_date'] . " " . $time;
        $full_booking_day = strtolower(date("D", strtotime($full_booking_time)));
        $booking_time = date('h:i A', strtotime($full_booking_time));
        if (empty($time)) {
            $booking_time = '';
        }

        $merchant_id = isset($data['merchant_id']) ? $data['merchant_id'] : '';
        if (!Yii::app()->functions->isMerchantOpenTimes($merchant_id, $full_booking_day, $booking_time)) {
            $date_close = date("F,d l Y h:ia", strtotime($full_booking_time));
            $date_close = Yii::app()->functions->translateDate($date_close);
            $data['msg'] = "Sorry but we are closed on $date_close . Please check merchant opening hours";
            return $data;
        }

        return $data;
    }

    public function getMerchantByApi($merchant_id = '') {
        $stmt = "SELECT a.merchant_id,a.restaurant_slug,a.restaurant_name,a.country_code,CONCAT(street,' ',city,' ',state,' ',post_code) as address,
		(
		select title
		from
		{{packages}}
		where
		package_id=a.package_id
		) as package_name
		 FROM
		{{merchant}} a
		WHERE
		merchant_id='" . $merchant_id . "'
		LIMIT 0,1
		";
        if ($res = $this->rst($stmt)) {
            return $res[0];
        }
        return false;
    }

    public function getClientByApi($client_id = '', $address_id = '') {

        $stmt = "SELECT 
    	       concat(a.street,' ',a.city,' ',a.state,' ',a.zipcode) as address,
    	       a.id,a.location_name,a.country_code,concat(c.first_name,' ',c.last_name) as name,c.contact_phone
    	       FROM
    	       {{address_book}} as a INNER JOIN {{client}} as c ON c.client_id = a.client_id
    	       WHERE
    	       a.client_id='$client_id'    	       
    	       AND
               a.id='$address_id'
    	       LIMIT 0,1";
        if ($res = $this->rst($stmt)) {
            return $res[0];
        }
        return $stmt;
    }

    public function orderCheckout($data = array()) {
        $responsive = array();
        if (empty($data['order_id'])) {
            // check date time valid
            $data = $this->validDeliveryOptDateTime($data);
            if (isset($data['msg']) && !empty($data['msg'])) {
                $response['msg'] = $data['msg'];
                $response['code'] = 0;
                return $response;
            }
            // get merchant info
            $merchant_info = $this->getMerchantByApi($data['merchant_id']);
            if (empty($merchant_info)) {
                $response['msg'] = 'merchant are not found in our records';
                $response['code'] = 0;
                return $response;
            }
            // get client info
            $client_info = $this->getClientByApi($data['client_id'], $data['address_book_id']);
            if (empty($client_info)) {
                $response['msg'] = 'current client are not found in our records';
                $response['code'] = 0;
                return $response;
            }
            $data['client_info'] = $client_info;
            $data['merchant_info'] = $merchant_info;

            // get minium order
            $minimum_order = Yii::app()->functions->getOption('merchant_minimum_order', $data['merchant_id']);
            if (!empty($minimum_order)) {
                $data['minimum_order'] = $minimum_order;
            }
            $mt_timezone = Yii::app()->functions->getOption("merchant_timezone", $data['merchant_id']);
            $data['timezone'] = $mt_timezone;

            // check delivery distance
            $functionsk = new FunctionsK();
            $shipping = $functionsk->reCheckDeliveryApi($data, $data['merchant_id']);
            $data['shipping_fee'] = ($shipping > 1) ? $shipping : 0;
            if (empty($shipping) && $shipping > 1) {
                $mt_delivery_miles = Yii::app()->functions->getOption("merchant_delivery_miles", $data['merchant_id']);
                $unit = Yii::app()->functions->getOption("merchant_distance_type", $data['merchant_id']);
                $response['msg'] = "Sorry but this merchant delivers only with in $mt_delivery_miles $unit";
                $response['code'] = 0;
                return $response;
            }
            // check order status
            $default_order_status = Yii::app()->functions->getOption("default_order_status", $data['merchant_id']);
            $data['default_order_status'] = $default_order_status;

            // voucher apply
            $voucher_code = isset($data['offer_code']) ? $data['offer_code'] : 0;
            if ($voucher_code) {
                $res = $this->getVoucherCodeByAdmin($voucher_code, $data['client_id']);
                if (!empty($res) && count($res) >= 1) {
                    $data['voucher_code'] = $res;
                } else {
                    $res = $this->getVoucherCodeByMerchant($voucher_code, $data['merchant_id'], $data['client_id']);
                    $data['voucher_code'] = $res;
                }
                $data['voucher_code']['voucher_code'] = $voucher_code;
            }

            $order_item = $data['cart_item'];
            if (is_array($order_item) && count($order_item) >= 1) {
                Yii::app()->functions->displayOrderApi($data, $order_item);
                $msg = Yii::app()->functions->msg;
                $code = Yii::app()->functions->code;
                $raw = Yii::app()->functions->details['raw'];
                if ($msg == 'OK' && $code == 1) {
                    if (is_array($raw) && count($raw) >= 1) {

                        $params = array(
                            'merchant_id' => $data['merchant_id'],
                            'client_id' => $data['client_id'],
                            'json_details' => json_encode($order_item),
                            'trans_type' => isset($data['delivery_type']) ? $data['delivery_type'] : '',
                            'payment_type' => isset($data['payment_opt']) ? $data['payment_opt'] : '',
                            'sub_total' => isset($raw['total']['subtotal']) ? $raw['total']['subtotal'] : '',
                            'tax' => isset($raw['total']['tax']) ? $raw['total']['tax'] : '',
                            'taxable_total' => isset($raw['total']['taxable_total']) ? $raw['total']['taxable_total'] : '',
                            'total_w_tax' => isset($raw['total']['total']) ? $raw['total']['total'] : '',
                            'delivery_charge' => isset($raw['total']['delivery_charges']) ? $raw['total']['delivery_charges'] : '',
                            'delivery_date' => isset($data['delivery_date']) ? $data['delivery_date'] : '',
                            'delivery_time' => isset($data['delivery_time']) ? $data['delivery_time'] : '',
                            'delivery_asap' => isset($data['delivery_asap']) ? $data['delivery_asap'] : '',
                            'date_created' => date('c'),
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
                            'delivery_instruction' => isset($data['delivery_instruction']) ? $data['delivery_instruction'] : '',
                            'cc_id' => isset($data['cc_id']) ? $data['cc_id'] : '',
                            'order_change' => isset($data['order_change']) ? $data['order_change'] : '',
                            'payment_provider_name' => isset($data['payment_provider_name']) ? $data['payment_provider_name'] : '',
                        );

                        if ($data['payment_opt'] == "cod") {
                            if (!empty($default_order_status)) {
                                $params['status'] = $default_order_status;
                            } else
                                $params['status'] = "pending";
                        } else
                            $params['status'] = 'initial_order';

                        /* PROMO */
                        if (isset($raw['total']['discounted_amount'])) {
                            if ($raw['total']['discounted_amount'] >= 0.1) {
                                $params['discounted_amount'] = $raw['total']['discounted_amount'];
                                $params['discount_percentage'] = $raw['total']['merchant_discount_amount'];
                            }
                        }

                        /* VOUCHER */
                        $has_voucher = false;
                        if (isset($data['voucher_code'])) {
                            if (is_array($data['voucher_code'])) {
                                $params['voucher_amount'] = $data['voucher_code']['amount'];
                                $params['voucher_code'] = $data['voucher_code']['voucher_name'];
                                $params['voucher_type'] = $data['voucher_code']['voucher_type'];
                                $has_voucher = true;
                            }
                        }

                        /* Commission */
                        if (Yii::app()->functions->isMerchantCommission($data['merchant_id'])) {
                            $admin_commision_ontop = Yii::app()->functions->getOptionAdmin('admin_commision_ontop');
                            if ($com = Yii::app()->functions->getMerchantCommission($data['merchant_id'])) {
                                $params['percent_commision'] = $com;
                                $params['total_commission'] = ($com / 100) * $params['total_w_tax'];
                                $params['merchant_earnings'] = $params['total_w_tax'] - $params['total_commission'];
                                if ($admin_commision_ontop == 1) {
                                    $params['total_commission'] = ($com / 100) * $params['sub_total'];
                                    $params['commision_ontop'] = $admin_commision_ontop;
                                    $params['merchant_earnings'] = $params['sub_total'] - $params['total_commission'];
                                }
                            }

                            /** check if merchant commission is fixed  */
                            $merchant_com_details = Yii::app()->functions->getMerchantCommissionDetails($data['merchant_id']);

                            if ($merchant_com_details['commision_type'] == "fixed") {
                                $params['percent_commision'] = $merchant_com_details['percent_commision'];
                                $params['total_commission'] = $merchant_com_details['percent_commision'];
                                $params['merchant_earnings'] = $params['total_w_tax'] - $merchant_com_details['percent_commision'];

                                if ($admin_commision_ontop == 1) {
                                    $params['merchant_earnings'] = $params['sub_total'] - $merchant_com_details['percent_commision'];
                                }
                            }
                        }/** end commission condition */
                        // fixed packaging by saving the packaging charge to db
                        $merchant_packaging_charge = Yii::app()->functions->getOption('merchant_packaging_charge', $data['merchant_id']);
                        if ($merchant_packaging_charge > 0) {
                            $params['packaging'] = $merchant_packaging_charge;

                            /** if packaging is incremental */
                            if (Yii::app()->functions->getOption("merchant_packaging_increment", $data['merchant_id']) == 2) {
                                $total_cart_item = 0;
                                foreach ($raw['item'] as $cart_item_x) {
                                    $total_cart_item+=$cart_item_x['qty'];
                                }
                                $params['packaging'] = $total_cart_item * $merchant_packaging_charge;
                            }
                        }

                        /* if has address book selected */
                        if (isset($data['address_book_id'])) {
                            if ($address_book = Yii::app()->functions->getAddressBookByID($data['address_book_id'])) {
                                $data['street'] = $address_book['street'];
                                $data['city'] = $address_book['city'];
                                $data['state'] = $address_book['state'];
                                $data['zipcode'] = $address_book['zipcode'];
                                $data['location_name'] = $address_book['location_name'];
                            }
                        }
                        $country_code = '';
                        $country_name = '';
                        if (Yii::app()->functions->getOptionAdmin('website_enabled_map_address') == 2) {
                            if (isset($data['map_address_toogle'])) {
                                if ($data['map_address_toogle'] == 2) {
                                    $geo_res = geoCoding($data['map_address_lat'], $data['map_address_lng']);
                                    if ($geo_res) {
                                        //dump($geo_res);
                                        $data['street'] = isset($geo_res['street_number']) ? $geo_res['street_number'] . " " : '';
                                        $data['street'].=isset($geo_res['street']) ? $geo_res['street'] . " " : '';
                                        $data['street'].=isset($geo_res['street2']) ? $geo_res['street2'] . " " : '';

                                        $data['city'] = $geo_res['locality'];
                                        $data['state'] = $geo_res['admin_1'];
                                        $data['zipcode'] = isset($geo_res['postal_code']) ? $geo_res['postal_code'] : '';
                                        $country_code = $geo_res['country_code'];
                                        $country_name = $geo_res['country'];
                                    } else {
                                        $response['msg'] = "Sorry but something wrong when geocoding your address";
                                        $response['code'] = 0;
                                        return $response;
                                    }
                                }
                            }
                        }
                        /** check if item is taxable */
                        if (Yii::app()->functions->getOption("merchant_tax_charges", $data['merchant_id']) == 2) {
                            $params['donot_apply_tax_delivery'] = 2;
                        }

                        if ($this->insertData("{{order}}", $params)) {
                            $order_id = Yii::app()->db->getLastInsertID();

                            /** add delivery address */
                            if ($data['delivery_type'] == "delivery") {
                                $params_address = array(
                                    'order_id' => $order_id,
                                    'client_id' => $data['client_id'],
                                    'street' => isset($data['street']) ? $data['street'] : '',
                                    'city' => isset($data['city']) ? $data['city'] : '',
                                    'state' => isset($data['state']) ? $data['state'] : '',
                                    'zipcode' => isset($data['zipcode']) ? $data['zipcode'] : '',
                                    'location_name' => isset($data['location_name']) ? $data['location_name'] : '',
                                    'country' => Yii::app()->functions->adminCountry(),
                                    'date_created' => date('c'),
                                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                                    'contact_phone' => $client_info['contact_phone']
                                );

                                if (!empty($country_name)) {
                                    $params_address['country'] = $country_name;
                                } else {
                                    $params_address['country'] = 'India';
                                }

                                $this->insertData("{{order_delivery_address}}", $params_address);

                                /** quick update mobile */
                                $params_mobile = array(
                                    'contact_phone' => $client_info['contact_phone'],
                                    'location_name' => isset($data['location_name']) ? $data['location_name'] : ''
                                );
                                $this->updateData("{{client}}", $params_mobile, 'client_id', $data['client_id']);
                            }

                            /* VOUCHER */
                            if ($has_voucher == TRUE) {
                                Yii::app()->functions->updateVoucher($data['voucher_code']['voucher_name'], $data['client_id'], $order_id);
                            }

                            foreach ($raw['item'] as $val) {
                                $params_order_details = array(
                                    'order_id' => $order_id,
                                    'client_id' => $data['client_id'],
                                    'item_id' => isset($val['item_id']) ? $val['item_id'] : '',
                                    'item_name' => isset($val['item_name']) ? $val['item_name'] : '',
                                    'order_notes' => isset($val['order_notes']) ? $val['order_notes'] : '',
                                    'normal_price' => isset($val['normal_price']) ? $val['normal_price'] : '',
                                    'discounted_price' => isset($val['discounted_price']) ? $val['discounted_price'] : '',
                                    'size' => isset($val['size_words']) ? $val['size_words'] : '',
                                    'qty' => isset($val['qty']) ? $val['qty'] : '',
                                    'addon' => isset($val['sub_item']) ? json_encode($val['sub_item']) : '',
                                    'cooking_ref' => isset($val['cooking_ref']) ? $val['cooking_ref'] : '',
                                    'ingredients' => isset($val['ingredients']) ? json_encode($val['ingredients']) : '',
                                    'non_taxable' => isset($val['non_taxable']) ? $val['non_taxable'] : 1
                                );
                                $this->insertData("{{order_details}}", $params_order_details);
                            }

                            $order_detail = array(
                                'order_id' => $order_id,
                                'payment_type' => $data['payment_opt']
                            );

                            $dataArray = array(
                                'order_id' => $order_id,
                                'client_id' => $data['client_id'],
                                'merchant_id' => $data['merchant_id']
                            );

                            switch ($data['payment_opt']) {
                                case "cod":
                                    $receipt = $this->getReceipt($dataArray);
                                    $response['msg'] = 'Your order has been placed';
                                    $response['code'] = 1;
                                    $response['list'] = $order_detail;
                                    $response['receipt'] = ($receipt) ? $receipt : array();
                                    return $response;
                                    break;
                                case "cca":
                                    $response['msg'] = 'Please wait while we redirect...';
                                    $response['code'] = 1;
                                    $response['list'] = $order_detail;
                                    return $response;
                                    break;
                                case "payu":
                                    $response['msg'] = 'Please wait while we redirect...';
                                    $response['code'] = 1;
                                    $response['list'] = $order_detail;
                                    return $response;
                                    break;
                                default:
                                    $response['msg'] = 'Please select at least ane payment option';
                                    $response['code'] = 0;
                                    return $response;
                                    break;
                            }
                        } else {
                            $response['msg'] = 'Something went wrong';
                            $response['code'] = 0;
                            return $response;
                        }
                        /* dump($order_id);
                          dump($raw);
                          dump($data); */
                    } else {
                        $response['msg'] = 'Something went wrong';
                        $response['code'] = 0;
                        return $response;
                    }
                } else {
                    $response['msg'] = $msg;
                    $response['code'] = 0;
                    return $response;
                }
            } else {
                $response['msg'] = "No Item added yet";
                $response['code'] = 0;
                return $response;
            }
        } else {

            if (is_numeric($data['order_id'])) {
                if (!empty($data['merchant_id']) && !empty($data['client_id'])) {

                    if (strtolower($data['status']) == "success") {
                        $decryptValues = (isset($data['payment_records'])) ? $data['payment_records'] : array();
                        $tracking_id = isset($data['tracking_id']) ? $data['tracking_id'] : 0;
                        $receipt = $this->getReceipt($data);
                        if (strtolower($data['payment_opt']) == 'cca') {
                            $params_logs = array(
                                'order_id' => $data['order_id'],
                                'payment_type' => Yii::app()->functions->paymentCode('ccavenue'),
                                'raw_response' => json_encode($decryptValues),
                                'date_created' => date('c'),
                                'ip_address' => $_SERVER['REMOTE_ADDR'],
                                'payment_reference' => $tracking_id
                            );
                            $this->insertData("{{payment_order}}", $params_logs);
                            $params_update = array('status' => 'paid');
                            $this->updateData("{{order}}", $params_update, 'order_id', $data['order_id']);
                            $response['msg'] = "Your order has been placed";
                            $response['code'] = 1;
                            $response['list'] = array();
                            $response['receipt'] = ($receipt) ? $receipt : array();
                            return $response;
                        } elseif (strtolower($data['payment_opt']) == 'payu') {

                            $params_logs = array(
                                'order_id' => $data['order_id'],
                                'payment_type' => Yii::app()->functions->paymentCode('payumoney'),
                                'raw_response' => json_encode($decryptValues),
                                'date_created' => date('c'),
                                'ip_address' => $_SERVER['REMOTE_ADDR'],
                                'payment_reference' => $tracking_id
                            );
                            $this->insertData("{{payment_order}}", $params_logs);
                            $params_update = array('status' => 'paid');
                            $this->updateData("{{order}}", $params_update, 'order_id', $data['order_id']);
                            $response['msg'] = "Your order has been placed";
                            $response['code'] = 1;
                            $response['list'] = array();
                            $response['receipt'] = ($receipt) ? $receipt : array();
                            return $response;
                        } else {

                            $response['msg'] = "can not complete payment process";
                            $response['code'] = 0;
                            return $response;
                        }
                    } else {
                        $response['msg'] = "can not complete payment process";
                        $response['code'] = 0;
                        return $response;
                    }
                } else {
                    $response['msg'] = "client id & merchant id is required";
                    $response['code'] = 0;
                    return $response;
                }
            } else {
                $response['msg'] = "invalid order id";
                $response['code'] = 0;
                return $response;
            }
        }
    }

    public function getReceipt($data = array()) {
        $response = array();
        if (!empty($data['order_id']) && $data['client_id'] && $data['merchant_id']) {

            if ($receipt = Yii::app()->functions->getOrderApi($data['order_id'], $data['client_id'])) {

                $merchant_id = $receipt['merchant_id'];
                $json_details = !empty($receipt['json_details']) ? json_decode($receipt['json_details'], true) : false;
                if ($json_details != false) {
                    Yii::app()->functions->displayOrderApi($receipt, $json_details, true);
                    if (Yii::app()->functions->code == 1) {
                        $ok = true;
                    }
                }
                $item_details = Yii::app()->functions->details['raw'];
                

                $merchant_info = Yii::app()->functions->getMerchant($data['merchant_id']);
                $full_merchant_address = $merchant_info['street'] . " " . $merchant_info['city'] . " " . $merchant_info['state'] .
                        " " . $merchant_info['post_code'];

                if (!empty($receipt['location_name1'])) {
                    $receipt['location_name'] = $receipt['location_name1'];
                }

                if (!empty($receipt['contact_phone1'])) {
                    $receipt['contact_phone'] = $receipt['contact_phone1'];
                }
                // dump($item_details);
                $response['order_id'] = (isset($receipt['order_id'])) ? $receipt['order_id'] : 0;
                $response['merchant_id'] = (isset($receipt['merchant_id'])) ? $receipt['merchant_id'] : 0;
                $response['delivery_type'] = (isset($receipt['trans_type'])) ? $receipt['trans_type'] : 0;
                $response['payment_type'] = (isset($receipt['payment_type'])) ? $receipt['payment_type'] : 0;
                $response['client_name'] = (isset($receipt['full_name'])) ? $receipt['full_name'] : 0;
                $response['merchant_name'] = (isset($receipt['merchant_name'])) ? $receipt['merchant_name'] : 0;
                $response['abn'] = ($receipt['abn']) ? $receipt['abn'] : 0;
                $response['merchant_contact_phone'] = (isset($receipt['merchant_contact_phone'])) ? $receipt['merchant_contact_phone'] : 0;
                $response['merchant_address'] = (isset($full_merchant_address)) ? $full_merchant_address : 0;
                $response['payment_provider_name'] = (isset($receipt['payment_provider_name'])) ? $receipt['payment_provider_name'] : 0;
                $response['payment_reference'] = (isset($receipt['payment_reference'])) ? $receipt['payment_reference'] : 0;
                $response['transaction_date'] = (isset($receipt['date_created'])) ? date('M d,Y G:i:s', strtotime($data['date_created'])) : 0;
                $response['delivery_date'] = (isset($receipt['delivery_date'])) ? Yii::app()->functions->prettyDate($receipt['delivery_date']) : 0;
                $response['delivery_time'] = (isset($receipt['delivery_time'])) ? $receipt['delivery_time'] : 0;
                $response['delivery_address'] = (isset($receipt['client_full_address'])) ? $receipt['client_full_address'] : 0;
                $response['location_name'] = (isset($receipt['location_name'])) ? $receipt['location_name'] : 0;
                $response['contact_phone'] = (isset($receipt['contact_phone'])) ? $receipt['contact_phone'] : 0;
                // total amount
                $response['subtotal_item'] = (isset($item_details['total']['item_sub_total'])) ? $item_details['total']['item_sub_total'] : 0;
                $response['less_voucher_amt'] = (isset($item_details['total']['less_voucher'])) ? $item_details['total']['less_voucher'] : 0;
                $response['subtotal'] = (isset($item_details['total']['subtotal'])) ? $item_details['total']['subtotal'] : 0;
                $response['tax_charges'] = (isset($item_details['total']['tax_amt'])) ? $item_details['total']['tax_amt'] . '%' : 0;
                $response['taxable_amt_total'] = (isset($item_details['total']['taxable_total'])) ? $item_details['total']['taxable_total'] : 0;
                $response['delivery_charges'] = (isset($item_details['total']['delivery_charges'])) ? round($item_details['total']['delivery_charges']) : 0;
                $response['merchant_packaging_charge'] = ($item_details['total']['merchant_packaging_charge']) ? $item_details['total']['merchant_packaging_charge'] : 0;
                $response['discounted_amount'] = (isset($item_details['total']['discounted_amount'])) ? $item_details['total']['discounted_amount'] : 0;
                $response['merchant_discount_amount'] = (isset($item_details['total']['merchant_discount_amount'])) ? $item_details['total']['merchant_discount_amount'] : 0;
                $response['total_amount'] = (isset($item_details['total']['total'])) ? $item_details['total']['total'] : 0;
                // total item
                $response['item'] = (isset($item_details['item'])) ? $item_details['item'] : 0;
                
                $this->setReceiptByMail($item_details,$receipt,$merchant_info);
                return $response;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function printReceiptOnMailData($data = array(),$detail = array(),$merchant_info = array()){
        
            $full_merchant_address = $merchant_info['street'] . " " . $merchant_info['city'] . " " . $merchant_info['state'] .
                            " " . $merchant_info['post_code'];
            if (!empty($detail['client_full_address'])){
                           $delivery_address=$detail['client_full_address'];
            } 
            if (!empty($detail['location_name1'])){
                $detail['location_name']=$detail['location_name1'];
            }
            if ( !empty($detail['contact_phone1'])){
                $detail['contact_phone']=$detail['contact_phone1'];
            }
           $print='';
           $print=array(array(
	         'label'=>"Customer Name",
	         'value'=>$detail['full_name']
	         ),
                 array(
	         'label'=>"Merchant Name",
	         'value'=>$detail['merchant_name']
	         ),
               array(
	         'label'=>"ABN",
	         'value'=>$detail['abn']
	         ),
               array(
	         'label'=>"Telephone",
	         'value'=>$detail['merchant_contact_phone']
	         ),
               array(
	         'label'=>"Address",
	         'value'=>$full_merchant_address
	         ),
               array(
	         'label'=>"TRN Type",
	         'value'=>$detail['trans_type']
	         ),
               array(
	         'label'=>"Payment Type",
	         'value'=>$detail['payment_type']
	         ),
               array(
	         'label'=>"Card#",
	         'value'=>$detail['payment_provider_name']
	         ),
               array(
	         'label'=>"Reference #",
	         'value'=>$detail['order_id']
	         ),
               array(
	         'label'=>"Payment Ref",
	         'value'=>$detail['order_id']
	         ),
               array(
	         'label'=>"TRN Date",
	         'value'=>date('M d,Y G:i:s',strtotime($detail['date_created']))
	         ),
               array(
	         'label'=>"Delivery Date",
	         'value'=> Yii::app()->functions->prettyDate($detail['delivery_date'])
	         ),
               array(
	         'label'=>"Delivery Time",
	         'value'=>$detail['delivery_time']
	         ),
               array(
	         'label'=>"Deliver to",
	         'value'=>$delivery_address
	         ),
               array(
	         'label'=>"Location Name",
	         'value'=>$detail['location_name']
	         ),
               array(
	         'label'=>"Contact Number",
	         'value'=>$detail['contact_phone']
	         )
               );
           
           return $print;
    }

    public function setReceiptByMail($data = array(),$detail = array(),$merchant_info = array()) {

        $data_raw = $data;
        $print = $this->printReceiptOnMailData($data,$detail,$merchant_info);
        $merchant_id = $detail['merchant_id'];
        
        $receipt = EmailTPL::salesReceipt($print, $data);
        $tpl = Yii::app()->functions->getOption("receipt_content", $merchant_id);
        if (empty($tpl)) {
            $tpl = EmailTPL::receiptTPL();
        }
        
        $tpl = Yii::app()->functions->smarty('receipt', $receipt, $tpl);
        $tpl = Yii::app()->functions->smarty('customer-name', $detail['full_name'], $tpl);
        $tpl = Yii::app()->functions->smarty('receipt-number', Yii::app()->functions->formatOrderNumber($detail['order_id']), $tpl);
        
        $receipt_sender = Yii::app()->functions->getOption("receipt_sender", $merchant_id);
        $receipt_subject = Yii::app()->functions->getOption("receipt_subject", $merchant_id);
        
        if (empty($receipt_subject)) {
            $receipt_subject = getOptionA('receipt_default_subject');
            if (empty($receipt_subject)) {
                $receipt_subject = "We have receive your order";
            }
        }
        
        if (empty($receipt_sender)) {
            $receipt_sender = 'info@bhukkas.com';
        }
        $to = isset($detail['email_address']) ? $detail['email_address'] : '';
        
         if (!in_array($detail['order_id'])) {
           
            sendEmail($to, $receipt_sender, $receipt_subject, $tpl,'order detail');
            /* send email to merchant address */
            $merchant_notify_email = Yii::app()->functions->getOption("merchant_notify_email", $merchant_id);
            $enabled_alert_notification = Yii::app()->functions->getOption("enabled_alert_notification", $merchant_id);
            /* dump($merchant_notify_email);
              dump($enabled_alert_notification); */
            if ($enabled_alert_notification == "") {

                $merchant_receipt_subject = Yii::app()->functions->getOption("merchant_receipt_subject", $merchant_id);

                $merchant_receipt_subject = empty($merchant_receipt_subject) ? t("New Order From") .
                        " " . $detail['full_name'] : $merchant_receipt_subject;

                $merchant_receipt_content = Yii::app()->functions->getMerchantReceiptTemplate($merchant_id);

                $final_tpl = '';
                if (!empty($merchant_receipt_content)) {
                    $merchant_token = Yii::app()->functions->getMerchantActivationToken($merchant_id);
                    $confirmation_link = Yii::app()->getBaseUrl(true) . "/store/confirmorder/?id=" . $detail['order_id'] . "&token=$merchant_token";
                    $final_tpl = Yii::app()->functions->smarty('receipt-number', Yii::app()->functions->formatOrderNumber($detail['order_id'])
                            , $merchant_receipt_content);
                    $final_tpl = Yii::app()->functions->smarty('customer-name', $detail['full_name'], $final_tpl);
                    $final_tpl = Yii::app()->functions->smarty('receipt', $receipt, $final_tpl);
                    $final_tpl = Yii::app()->functions->smarty('confirmation-link', $confirmation_link, $final_tpl);
                } else
                    $final_tpl = $tpl;

                $global_admin_sender_email = Yii::app()->functions->getOptionAdmin('global_admin_sender_email');
                if (empty($global_admin_sender_email)) {
                    $global_admin_sender_email = $receipt_sender;
                }

                // fixed if email is multiple
                $merchant_notify_email = explode(",", $merchant_notify_email);
                if (is_array($merchant_notify_email) && count($merchant_notify_email) >= 1) {
                    foreach ($merchant_notify_email as $merchant_notify_email_val) {
                        if (!empty($merchant_notify_email_val)) {
                            sendEmail(trim($merchant_notify_email_val), $global_admin_sender_email, $merchant_receipt_subject, $final_tpl,'order detail');
                        }
                    }
                }
            }
            
                 // send SMS    
            Yii::app()->functions->SMSnotificationMerchant($merchant_id, $detail, $data_raw);

            // SEND FAX
            Yii::app()->functions->sendFax($merchant_id, $detail['id']);
         }
         
         return true;
    }
    
    public function getMerchantDeals($data = array()) {
        $response = array();
        $cuisine_list = Yii::app()->functions->Cuisine(true);
        $city = $data['cityName'];


        if (isset($data['offset']) && !empty($data['offset'])) {
            $Start_page = $data['offset'];
        } else {
            $Start_page = 0;
        }

        if (isset($data['limit']) && !empty($data['limit'])) {
            $per_page = $data['limit'];
        } else {
            $per_page = 10;
        }

        $and = "AND a.status='active' ";
        $and.="AND a.is_ready='2' ";
        $and.="AND b.status='publish' ";
        $and.="AND now() >= b.valid_from and now() <= b.valid_to";
        // filter
        $sort_by = "distance ASC";
        $sort_by0 = " ORDER BY is_sponsored DESC";
        $sort_combine = "$sort_by0,$sort_by";

        $address = $city;
        $latlang = Yii::app()->functions->geodecodeAddress($address);
        $lat = round($latlang['lat'], 6);
        $long = round($latlang['long'], 6);
        $radius = 50;

        $client_id = 0;
        if (isset($data['client_id']) && !empty($data['client_id'])) {
            $client_id = $data['client_id'];
        }

        $stmt = " SELECT SQL_CALC_FOUND_ROWS a.merchant_id,a.restaurant_slug,a.restaurant_name,a.restaurant_phone,
                   a.service,a.free_delivery,a.merchant_category,a.latitude,a.lontitude,a.cuisine,
                   a.delivery_charges,a.minimum_order,a.ratings ,(
                   6371 * acos( cos( radians(  $lat ) ) * cos( radians( a.latitude ) ) * cos( radians( a.lontitude ) - radians( $long  ) ) + sin( radians(  $lat  ) ) * sin( radians( a.latitude ) ) )
                   ) AS distance,b.offers_id,b.offer_percentage,b.offer_price,b.valid_from,b.valid_to
                    FROM {{view_merchant}} a INNER JOIN {{offers}} as b ON b.merchant_id = a.merchant_id 
                    WHERE a.city LIKE '" . $city . "%'
                    $and  HAVING distance <= $radius 
                    $sort_combine
                    LIMIT $Start_page,$per_page
                    ";
        $stmt2 = "SELECT FOUND_ROWS()";
        $count_query = true;
        $result = array();
        if ($res = $this->rst($stmt)) {

            $this->search_result_total = 0;
            if ($res_total = $this->rst($stmt2)) {

                if ($count_query == true) {
                    $this->search_result_total = $res_total[0]['FOUND_ROWS()'];
                } else
                    $this->search_result_total = $res_total[0]['total_records'];
            }

            foreach ($res as $rows):

                $temp = array();

                $resto_cuisine = "";
                $cuisine = !empty($rows['cuisine']) ? (array) json_decode($rows['cuisine']) : false;
                if ($cuisine != false) {
                    foreach ($cuisine as $valc) {
                        if (array_key_exists($valc, (array) $cuisine_list)) {
                            $resto_cuisine.=$cuisine_list[$valc] . " / ";
                        }
                    }
                    $resto_cuisine = !empty($resto_cuisine) ? substr($resto_cuisine, 0, -2) : 0;
                }
                $merchant_photo = Yii::app()->functions->getOption("merchant_photo", $rows['merchant_id']);


                if (!empty($merchant_photo)) {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/upload/" . $merchant_photo;
                } else {
                    $photo_url = $this->siteUrls . Yii::app()->getBaseUrl() . "/assets/images/100X100.png";
                }


                /*$delivery_fee = $rows['delivery_charges'];
                if (is_numeric($delivery_fee) && $delivery_fee >= 1) {
                    $fee = $delivery_fee;
                } else {
                    $fee = "Free Delivery";
                }*/
                
                /*$delivery_est = Yii::app()->functions->getOption("merchant_delivery_estimation", $rows['merchant_id']);
                $mt_delivery_miles = Yii::app()->functions->getOption("merchant_delivery_miles", $rows['merchant_id']);
                if (is_numeric($mt_delivery_miles)) {
                    $mt_delivery_miles = $mt_delivery_miles;
                } else {
                    $mt_delivery_miles = 0;
                }*/

                /*$validOffer = 0;
                if ($offer = Yii::app()->functions->getMerchantOffersActive($rows['merchant_id'])) {
                    $validOffer = number_format($offer['offer_percentage'], 0) . '%';
                }*/
                
                $open = "Closed";
                $is_merchant_open = Yii::app()->functions->isMerchantOpen($rows['merchant_id']);
                if ($is_merchant_open == TRUE) {
                    $open = "Open";
                }

                $temp['merchant_id'] = $rows['merchant_id'];
                $temp['restaurant_slug'] = $rows['restaurant_slug'];
                $temp['restaurant_name'] = $rows['restaurant_name'];
                $temp['restaurant_phone'] = isset($rows['restaurant_phone']) ? $rows['restaurant_phone'] : 0;
                $temp['free_delivery'] = (isset($rows['free_delivery'])) ? $rows['free_delivery'] : 0;
                $temp['merchant_category'] = (isset($rows['merchant_category'])) ? $rows['merchant_category'] : 0;
                $temp['latitude'] = (isset($rows['latitude'])) ? $rows['latitude'] : 0;
                $temp['lontitude'] = (isset($rows['lontitude'])) ? $rows['lontitude'] : 0;
                /*$temp['delivery_charges'] = $fee;*/
                $temp['minimum_order'] = (isset($rows['minimum_order'])) ? $rows['minimum_order'] : 0;
                /*$temp['ratings'] = (isset($rows['ratings'])) ? $rows['ratings'] : 0;*/
                $temp['cuisine'] = $resto_cuisine;
                $temp['merchant_photo'] = $photo_url;
                /*$temp['delivery_estimation_time'] = ($delivery_est) ? $delivery_est : 0;*/
                /*$temp['delivery_in'] = $mt_delivery_miles;*/
                $temp['offers_id'] = (isset($rows['offers_id'])) ? $rows['offers_id'] : 0;
                $temp['offer_percentage'] = (isset($rows['offer_percentage'])) ? number_format((float)$rows['offer_percentage'],1,'.','') : 0;
                $temp['offer_price'] = (isset($rows['offer_price'])) ? number_format((float)$rows['offer_price'],1,'.','') : 0;
                $temp['valid_from'] = (isset($rows['valid_from'])) ? $rows['valid_from'] : 0;
                $temp['valid_to'] = (isset($rows['valid_to'])) ? $rows['valid_to'] : 0;
                $temp['distance'] = number_format((float) $rows['distance'], 1, '.', '');
                $temp['is_open'] = $open;

                $result [] = $temp;
            endforeach;

            $response['msg'] = $this->search_result_total . " offer in your zone";
            $response['code'] = 1;
            $response['total_rows'] = $this->search_result_total;
            $response['list'] = $result;
            return $response;
        } else {
            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
            return $response;
        }
    }
    
    public function getOrderTracker($data = array()){
       $response = array();
       $order_id = $data['order_id'];
       $stmt="SELECT id,order_id,status,remarks,date_created FROM
                {{order_history}}
                WHERE
                order_id=".$order_id."
                ORDER BY id ASC
                ";
    	if ( $res=$this->rst($stmt)){
    	    $response['msg'] = "your order status has been found";
            $response['code'] = 1;
            $response['list'] = $res;
            return $response;
        }else{
            $response['msg'] = "Sorry but we cannot find what you are looking for";
            $response['code'] = 0;
            return $response;  
        }
    }


    public function setOrderHistory($data = array()){
             

            $params = array(
                    'order_id'      => $data['order_id'],
                    'status'        => $data['status'],
                    'remarks'       => $data['remarks'],
                    'date_created'  => date('c'),
                );

                if ($this->insertData("{{order_history}}", $params)) {
                    $response['msg']    = "Order History Updated";
                    $response['code']   = 1;
                } else {
                    $response['msg']    = "cannot insert records";
                    $response['code']   = 0;
                } 

                return $response; 

    }

}
