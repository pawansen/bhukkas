<?php

/*
 * ApiController Controller
 * 
 */
if (!isset($_SESSION)) {
    session_start();
}

include 'RestController.php';

class ApiController extends RestController {

    public $connection;

    public function __construct() {
        $this->connection = new ApiFunction();
    }

    /**
     * @project Bhukkas
     * @method getCityList
     * @description get city list
     * @access public
     * @keywords 
     * @return array
     */
    public function actiongetCityList() {
        $data = array();
        $list = $this->connection->getCityList();
        if ($list) {
            $data['status'] = 200;
            $data ['list'] = $list;
            $this->sendResponse(200, CJSON::encode($data));
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getLocationList
     * @description get location list
     * @access public
     * @keywords 
     * @return array
     */
    public function actiongetLocationList() {
        $data = array();
        $list = $this->connection->getLocationList();
        if ($list) {
            $data['status'] = 200;
            $data ['list'] = $list;
            $this->sendResponse(200, CJSON::encode($data));
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getLocationByCity
     * @description get location list by cityid
     * @access public
     * @keywords cityid
     * @return array
     */
    public function actiongetLocationByCity() {

        $data = array();
        if (isset($_POST['cityid']) && !empty($_POST['cityid'])) {
            $list = $this->connection->getLocationByCity($_POST['cityid']);
            if ($list) {
                $data['status'] = 200;
                $data['message'] = 'found records';
                $data ['list'] = $list;
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = 'Not found records';
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'city id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getCuisineList
     * @description get cusisine list
     * @access public
     * @keywords 
     * @return array
     */
    public function actiongetCuisineList() {
        $data = array();
        $list = $this->connection->getCuisineList();
        if ($list) {
            $data['status'] = 200;
            $data['message'] = 'found records';
            $data ['list'] = $list;
            $this->sendResponse(200, CJSON::encode($data));
        } else {
            $data['status'] = 400;
            $data['message'] = 'Not found records';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getAdminSocialLink
     * @description get social link
     * @access public
     * @keywords 
     * @return array
     */
    public function actiongetAdminSocialLink() {
        $data = array();
        $list['fb'] = Yii::app()->functions->getOptionAdmin("admin_fb_page");
        $list['twitter'] = Yii::app()->functions->getOptionAdmin("admin_twitter_page");
        $list['google'] = Yii::app()->functions->getOptionAdmin("admin_google_page");
        if ($list) {
            $data['status'] = 200;
            $data['message'] = 'found records';
            $data ['list'] = $list;
            $this->sendResponse(200, CJSON::encode($data));
        } else {
            $data['status'] = 400;
            $data['message'] = 'Not found records';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getAdminSocialLink
     * @description get admin contact detail
     * @access public
     * @keywords 
     * @return array
     */
    public function actiongetAdminContact() {
        $data = array();
        $list['address'] = Yii::app()->functions->getOptionAdmin('website_address');
        $list['phone'] = Yii::app()->functions->getOptionAdmin('website_contact_phone');
        $list['email'] = Yii::app()->functions->getOptionAdmin('website_contact_email');
        if ($list) {
            $data['status'] = 200;
            $data ['list'] = $list;
            $this->sendResponse(200, CJSON::encode($data));
        } else {
            $data['status'] = 400;
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method AddressList
     * @description get address list by client id
     * @access public
     * @keywords 
     * @return array
     */
    public function actionclientAddressList() {
        $data = array();

        if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
            $list = $this->connection->clientAddressList($_POST['client_id']);
            if ($list) {
                $data['status'] = 200;
                $data['message'] = 'records found';
                $data ['list'] = $list;
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = 'records not found';
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'client id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method clientUpdateAddress
     * @description get address list by client id
     * @access public
     * @keywords 
     * @return array
     */
    public function actionclientUpdateAddress() {
        $data = array();

        if (isset($_POST['address_id']) && !empty($_POST['address_id'])) {
            $list = $this->connection->clientUpdateAddress($_POST);
            if ($list) {
                $data['status'] = 200;
                $data['message'] = 'successfully update address';
                $data ['list'] = $list;
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = 'failed to update address';
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'address id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method clientAddAddress
     * @description get address list by client id
     * @access public
     * @keywords 
     * @return array
     */
    public function actionclientAddAddress() {
        $data = array();

        if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {

            $list = $this->connection->clientUpdateAddress($_POST);
            if ($list) {
                $data['status'] = 200;
                $data['message'] = 'successfully add address';
                $data ['list'] = $list;
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = 'failed to add address';
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'client id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method authRegistration
     * @description auth client register
     * @access public
     * @keywords
     * @return array
     */
    public function actionauthRegistration() {
        $data = array();

        if (isset($_POST) && !empty($_POST)) {

            $response = $this->connection->clientAuthRegistration($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method authLogin
     * @description auth client login
     * @access public
     * @keywords
     * @return array
     */
    public function actionauthLogin() {
        $data = array();
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['devicetoken']) && !empty($_POST['devicetype'])) {

            $response = $this->connection->authLogin($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Login Failed. Either username or password is incorrect';
            //$this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method authForgotPassword
     * @description auth client forgot password reset password
     * @access public
     * @keywords
     * @return array
     */
    public function actionauthForgotPassword() {
        $data = array();
        if (isset($_POST['username_email']) && !empty($_POST['username_email'])) {
            $response = $this->connection->authForgotPassword($_POST['username_email']);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Can not empty request email address';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method authUpdateProfile
     * @description auth client update profile
     * @access public
     * @keywords
     * @return array
     */
    public function actionauthUpdateProfile() {
        $data = array();
        if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['contact_phone']) && !empty($_POST['client_id'])) {
            $response = $this->connection->authUpdateProfile($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method authChangePassword
     * @description auth client update password
     * @access public
     * @keywords old_password,new_password,client_id
     * @return array
     */
    public function actionauthChangePassword() {
        $data = array();
        if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['client_id'])) {
            $response = $this->connection->authChangePassword($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getMerchantList
     * @description get merchant list by city and location
     * @access public
     * @keywords city,location
     * @return array
     */
    public function actiongetMerchantList() {



        $data = array();
        if (!empty($_POST['cityName']) && !empty($_POST['location'])) {
            $response = $this->connection->getMerchantList($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['total_result'] = $response['total_rows'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'please enter your city and location';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method addFavourite
     * @description client add favourite merchant
     * @access public
     * @keywords client_id,merchant_id
     * @return array
     */
    public function actionaddFavourite() {
        $data = array();
        if (!empty($_POST['client_id']) && !empty($_POST['merchant_id'])) {
            $response = $this->connection->addFavourite($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method removeFavourite
     * @description client remove favourite merchant
     * @access public
     * @keywords client_id,merchant_id
     * @return array
     */
    public function actionremoveFavourite() {
        $data = array();
        if (!empty($_POST['client_id']) && !empty($_POST['merchant_id'])) {
            $response = $this->connection->removeFavourite($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getFavouriteList
     * @description client get favourite merchant list
     * @access public
     * @keywords client_id,merchant_id
     * @return array
     */
    public function actiongetFavouriteList() {
        $data = array();
        if (!empty($_POST['client_id'])) {
            $response = $this->connection->getFavouriteList($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getMerchantByCity
     * @description get merchant by city
     * @access public
     * @keywords cityName
     * @return array
     */
    public function actiongetMerchantByCity() {
        $data = array();
        if (!empty($_POST['cityName'])) {
            $response = $this->connection->getMerchantByCity($_POST['cityName']);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getDetailMerchant
     * @description get merchant detail
     * @access public
     * @keywords merchant_id,latitude,lontitude
     * @return array
     */
    public function actiongetDetailMerchant() {
        $data = array();
        if (!empty($_POST['merchant_id'])) {
            $response = $this->connection->getDetailMerchant($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $data['work_hours'] = $response['work_hours'];
                $data['menu'] = $response['menu'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'merchant id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getMerchantReviewList
     * @description get merchant review list
     * @access public
     * @keywords merchant_id
     * @return array
     */
    public function actiongetMerchantReviewList() {
        $data = array();
        if (!empty($_POST['merchant_id'])) {
            $response = $this->connection->getMerchantReviewList($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'merchant id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method clientLeaveReview
     * @description client leave review rating
     * @access public
     * @keywords merchant_id,client_id
     * @return array
     */
    public function actionclientLeaveReview() {
        $data = array();
        if (!empty($_POST['merchant_id']) && !empty($_POST['client_id'])) {
            $response = $this->connection->clientLeaveReview($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'merchant id && client id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method clientUpdateReview
     * @description client update review rating
     * @access public
     * @keywords review_id,client_id
     * @return array
     */
    public function actionclientUpdateReview() {
        $data = array();
        if (!empty($_POST['review_id']) && !empty($_POST['client_id'])) {
            $response = $this->connection->clientUpdateReview($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'review id && client id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getClientReviewList
     * @description client review list
     * @access public
     * @keywords client_id
     * @return array
     */
    public function actiongetClientReviewList() {
        $data = array();
        if (!empty($_POST['client_id'])) {
            $response = $this->connection->getClientReviewList($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'client id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getClientReviewList
     * @description client review list
     * @access public
     * @keywords client_id
     * @return array
     */
    public function actiongetCms() {
        $data = array();
        if (!empty($_POST['cms_type'])) {
            $response = $this->connection->getCms($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'cms type required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method userContactAdmin
     * @description user contact to admin
     * @access public
     * @keywords name,email,phone,message,country
     * @return array
     */
    public function actionuserContactAdmin() {
        $data = array();
        if (!empty($_POST)) {
            $response = $this->connection->userContactAdmin($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'Something went wrong during processing your request. Please try again later';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getMerchantMenuDishes
     * @description get merchant menu dishes
     * @access public
     * @keywords merchant_id,cat_id
     * @return array
     */
    public function actiongetMerchantMenuDishes() {
        $data = array();
        if (!empty($_POST['merchant_id']) && !empty($_POST['cat_id'])) {
            $response = $this->connection->getMerchantMenuDishes($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'merchant id & category id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method applyVoucherCode
     * @description client apply voucher code
     * @access public
     * @keywords merchant_id,voucher_code,client_id
     * @return array
     */
    public function actionapplyVoucherCode() {
        $data = array();
        if (!empty($_POST['merchant_id']) && !empty($_POST['voucher_code'])) {
            if (!empty($_POST['client_id'])) {
                $response = $this->connection->applyVoucherCode($_POST);
                if ($response['code'] == 1) {
                    $data['status'] = 200;
                    $data['message'] = $response['msg'];
                    $data['list'] = $response['list'];
                    $this->sendResponse(200, CJSON::encode($data));
                } else {
                    $data['status'] = 400;
                    $data['message'] = $response['msg'];
                    $this->sendResponse(200, CJSON::encode($data));
                }
            } else {
                $data['status'] = 400;
                $data['message'] = 'client id required';
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'merchant id & voucher code required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method clientOrderList
     * @description client get order list
     * @access public
     * @keywords client_id,offset,limit
     * @return array
     */
    public function actionclientOrderList() {
        $data = array();
        if (!empty($_POST['client_id'])) {
            $response = $this->connection->clientOrderList($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'client id required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method getPaymentType
     * @description get payment type is available
     * @access public
     * @keywords merchant_id
     * @return array
     */
    public function actiongetPaymentType() {
        $data = array();
        if (!empty($_POST['merchant_id'])) {
            $response = $this->connection->getPaymentType($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'merchant id is required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method clientAddressRemove
     * @description client address remove
     * @access public
     * @keywords client_id,address_id
     * @return array
     */
    public function actionclientAddressRemove() {
        $data = array();
        if (!empty($_POST['client_id']) && !empty($_POST['address_id'])) {
            $response = $this->connection->clientAddressRemove($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'client id & address id is required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    /**
     * @project Bhukkas
     * @method orderCheckout
     * @description order checkout
     * @access public
     * @keywords merchant_id,client_id,delivery_type
     * @return array
     */
    public function actionorderCheckout() {
        $data = array();
        /* $params = '{"merchant_id":"11","client_id":"8","address_book_id":"15","payment_opt":"payu","delivery_time":"20:30","delivery_date":"2016-06-30","offer_code":"NEW1","order_id":"61","status":"success","delivery_type":"delivery","cart_item":[{"currentController":"store","merchant_id":11,"item_id":55,"price":"50|long","qty":1,"discount":"","notes":"","row":"","non_taxable":1},{"currentController":"store","merchant_id":11,"item_id":56,"price":"70|small","qty":29,"discount":"","notes":"","row":"","non_taxable":1},{"currentController":"store","merchant_id":11,"item_id":57,"price":"25|long","qty":1,"discount":"","notes":"","row":"","non_taxable":2},{"currentController":"store","merchant_id":11,"item_id":57,"price":"15|medium","qty":1,"discount":"","notes":"","row":"","non_taxable":2},{"currentController":"store","merchant_id":11,"item_id":57,"price":"5|small","qty":1,"discount":"","notes":"","row":"","non_taxable":2}]}'; */
        $params = $_POST['cart'];
        $parmete2 = json_decode($params, true);
        if (!empty($parmete2['merchant_id']) && !empty($parmete2['client_id'])) {
            if (!empty($parmete2['payment_opt'])) {

                if ($parmete2['payment_opt'] == 'cod' || $parmete2['payment_opt'] == 'cca' || $parmete2['payment_opt'] == 'payu') {

                    $parmete2['delivery_type'] = 'delivery';
                    $response = $this->connection->orderCheckout($parmete2);
                    if ($response['code'] == 1) {
                        $data['status'] = 200;
                        $data['message'] = $response['msg'];
                        $data['list'] = $response['list'];
                        $data['receipt'] = $response['receipt'];
                        $this->sendResponse(200, CJSON::encode($data));
                    } else {
                        $data['status'] = 400;
                        $data['message'] = $response['msg'];
                        $this->sendResponse(200, CJSON::encode($data));
                    }
                } else {
                    $data['status'] = 400;
                    $data['message'] = 'Please select at least one payment option';
                    $this->sendResponse(200, CJSON::encode($data));
                }
            } else {
                $data['status'] = 400;
                $data['message'] = 'Please select at least one payment option';
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'merchant id & client id is required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    public function actiongetOrderReceipt() {

        if (!empty($_POST['client_id']) && !empty($_POST['order_id']) && !empty($_POST['merchant_id'])) {
            $response = $this->connection->getReceipt($_POST);
            if ($response) {
                $data['status'] = 200;
                $data['message'] = 'Your receipt found successfully';
                $data['list'] = $response;
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = 'Your receipt not found';
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'client id & order id is required';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }
    
    
    /**
     * @project Bhukkas
     * @method getMerchantOffer
     * @description get merchant offer list by city
     * @access public
     * @keywords city,location
     * @return array
     */
    public function actiongetMerchantDeals() {
        $data = array();
        if (!empty($_POST['cityName'])) {
            $response = $this->connection->getMerchantDeals($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['total_result'] = $response['total_rows'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'please enter your city';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }
    
    
    /**
     * @project Bhukkas
     * @method OrderTracker
     * @description order tracker status by order id
     * @access public
     * @keywords order_id
     * @return array
     */
    
    public function actionOrderTracker(){
         $data = array();
        
        if (!empty($_POST['order_id'])) {
            $response = $this->connection->getOrderTracker($_POST);
            if ($response['code'] == 1) {
                $data['status'] = 200;
                $data['message'] = $response['msg'];
                $data['list'] = $response['list'];
                $this->sendResponse(200, CJSON::encode($data));
            } else {
                $data['status'] = 400;
                $data['message'] = $response['msg'];
                $this->sendResponse(200, CJSON::encode($data));
            }
        } else {
            $data['status'] = 400;
            $data['message'] = 'please enter your order id';
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    public function actionSaveOrderHistory(){
    $data = array();

    if (!empty($_POST['order_id'])) {
            $response = $this->connection->setOrderHistory($_POST);
            $this->sendResponse(200, CJSON::encode($response));
            } else {
            $data['status'] = 400;
            $data['message'] = 'please enter your order id';
            $this->sendResponse(200, CJSON::encode($data));
        }
       

    }

    

    public function actionCollectionDB() {

        $obj = new DbExt();

        for ($i = 10004; $i <= 15000; $i++) {
            // merchant
            $rest_phone = 9856254100;
            if ($i >= 10) {
                $rest_phone = '98563256' . $i;
            } elseif ($i >= 100) {
                $rest_phone = '9856325' . $i;
            } elseif ($i >= 1000) {
                $rest_phone = '985632' . $i;
            }elseif ($i >= 10000) {
                $rest_phone = '98563' . $i;
            }

            if ($i % 2 == 0) {

                $params = array(
                    'restaurant_slug' => 'Ambrosia_' . $i,
                    'restaurant_name' => 'Ambrosia',
                    'merchant_category' => 'restaurants',
                    'restaurant_phone' => $rest_phone,
                    'contact_name' => 'Abhay Singh',
                    'contact_phone' => 8602687858,
                    'contact_email' => 'Ambrosia_' . $i . '@gmail.com',
                    'country_code' => 'IN',
                    'street' => 'AB Road(Aagra Bombay Road)',
                    'city' => 'Indore',
                    'state' => 'Madhya Pradesh',
                    'post_code' => 452010,
                    'cuisine' => '["1","2","3","4","6","12","16","17","20","23","25"]',
                    'service' => 2,
                    'free_delivery' => 2,
                    'delivery_estimation' => '',
                    'username' => 'Ambrosia_' . $i,
                    'password' => 'e10adc3949ba59abbe56e057f20f883e',
                    'activation_key' => '',
                    'activation_token' => '',
                    'status' => 'active',
                    'date_created' => '2016-07-05 03:56:13',
                    'date_modified' => '',
                    'date_activated' => '',
                    'last_login' => '',
                    'ip_address' => '122.168.198.44',
                    'package_id' => 1,
                    'package_price' => '',
                    'membership_expired' => '2020-09-01',
                    'payment_steps' => 1,
                    'is_featured' => 1,
                    'is_ready' => 2,
                    'is_sponsored' => 1,
                    'sponsored_expiration' => '',
                    'lost_password_code' => '',
                    'user_lang' => '',
                    'membership_purchase_date' => '',
                    'sort_featured' => '',
                    'is_commission' => 2,
                    'percent_commision' => '10.00',
                    'abn' => '',
                    'session_token' => '48991742629cd5dafc22d4cd745f33e4b37b160f3ae',
                    'commision_type' => 'percentage',
                    'bank_name' => 'HDFC',
                    'account_number' => '50100895625123',
                    'branch' => 'TRADE HOUSE',
                    'ifsc_code' => 'HDFC0000036',
                    'sponsored_image' => '',
                );
            } else {

                $params = array(
                    'restaurant_slug' => 'radisson-blu-' . $i,
                    'restaurant_name' => 'Radisson Blu Hotel',
                    'merchant_category' => 'restaurants',
                    'restaurant_phone' => $rest_phone,
                    'contact_name' => 'Anurag verma',
                    'contact_phone' => 8602687858,
                    'contact_email' => 'radisson_blu' . $i . '@gmail.com',
                    'country_code' => 'IN',
                    'street' => 'Abhay Prashal',
                    'city' => 'Indore',
                    'state' => 'Madhya Pradesh',
                    'post_code' => 452010,
                    'cuisine' => '["1","2","3","4","6","12","16","17","20"]',
                    'service' => 2,
                    'free_delivery' => 2,
                    'delivery_estimation' => '',
                    'username' => 'radisson-blu_' . $i,
                    'password' => 'e10adc3949ba59abbe56e057f20f883e',
                    'activation_key' => '',
                    'activation_token' => '',
                    'status' => 'active',
                    'date_created' => '2016-07-05 03:56:13',
                    'date_modified' => '',
                    'date_activated' => '',
                    'last_login' => '',
                    'ip_address' => '122.168.198.44',
                    'package_id' => 1,
                    'package_price' => '',
                    'membership_expired' => '2020-09-01',
                    'payment_steps' => 1,
                    'is_featured' => 1,
                    'is_ready' => 2,
                    'is_sponsored' => 1,
                    'sponsored_expiration' => '',
                    'lost_password_code' => '',
                    'user_lang' => '',
                    'membership_purchase_date' => '',
                    'sort_featured' => '',
                    'is_commission' => 2,
                    'percent_commision' => '10.00',
                    'abn' => '',
                    'session_token' => '48991742629cd5dafc22d4cd745f33e4b37b160f3ae',
                    'commision_type' => 'percentage',
                    'bank_name' => 'ICICI',
                    'account_number' => '412563859632',
                    'branch' => '19/1, New Palasiya, Indore',
                    'ifsc_code' => 'ICIC0006570',
                    'sponsored_image' => '',
                );
            }

            $obj->insertData('{{merchant}}', $params);
            $insert_id = Yii::app()->db->getLastInsertID();

            $size_item = array(
                'date_created' => date('c'),
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'merchant_id' => $insert_id,
                'size_name' => 'small',
                'status' => 'publish'
            );

            $obj->insertData('{{size}}', $size_item);
            $size_id = Yii::app()->db->getLastInsertID();


            $category_item = array(
                'date_created' => date('c'),
                'merchant_id' => $insert_id,
                'category_name' => 'special',
                'category_description' => 'Chinese in Indore, Continental in Indore, Italian in Indore, North Indian in Indore, Punjabi in Indore',
                'status' => 'publish'
            );

            $obj->insertData('{{category}}', $category_item);
            $category_id = Yii::app()->db->getLastInsertID();

            //item insert
            if ($i % 2 == 0) {
                $option = array(
                    'table' => '{{item}}',
                    'where' => array('AND', 'merchant_id=2')
                );
            } else {
                $option = array(
                    'table' => '{{item}}',
                    'where' => array('AND', 'merchant_id=13')
                );
            }

            if ($rs = $obj->customGet($option)):
                foreach ($rs as $rows) {

                    $params_item = array(
                        'date_created' => date('c'),
                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                        'merchant_id' => $insert_id,
                        'item_name' => $rows['item_name'],
                        'item_description' => $rows['item_description'],
                        'status' => $rows['status'],
                        'category' => '["' . $category_id . '"]',
                        'price' => '{"' . $size_id . '":"550"}',
                        'addon_item' => '',
                        'cooking_ref' => $rows['cooking_ref'],
                        'discount' => 10,
                        'multi_option' => '',
                        'multi_option_value' => '',
                        'photo' => $rows['photo'],
                        'ingredients' => $rows['ingredients'],
                        'spicydish' => $rows['spicydish'],
                        'two_flavors' => $rows['two_flavors'],
                        'two_flavors_position' => $rows['two_flavors_position'],
                        'require_addon' => $rows['require_addon'],
                        'dish' => $rows['dish'],
                        'non_taxable' => $rows['non_taxable'],
                        'gallery_photo' => $rows['gallery_photo']
                    );
                    $obj->insertData('{{item}}', $params_item);
                }
            endif;

            if ($i % 2 == 0) {
                Yii::app()->functions->updateOption("merchant_minimum_order", 500, $insert_id);
                Yii::app()->functions->updateOption("merchant_tax", 10, $insert_id);
                Yii::app()->functions->updateOption("merchant_delivery_charges", 100, $insert_id);
                Yii::app()->functions->updateOption("stores_open_day", '["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]', $insert_id);
                Yii::app()->functions->updateOption("stores_open_starts", '{"monday":"10:00","tuesday":"10:00","wednesday":"10:00","thursday":"10:00","friday":"10:00","saturday":"10:00","sunday":"10:00"}', $insert_id);
                Yii::app()->functions->updateOption("stores_open_ends", '{"monday":"22:00","tuesday":"22:00","wednesday":"22:00","thursday":"22:00","friday":"22:00","saturday":"22:00","sunday":"22:00"}', $insert_id);
                Yii::app()->functions->updateOption("merchant_delivery_estimation", '1 hours', $insert_id);
                Yii::app()->functions->updateOption("merchant_delivery_miles", 10, $insert_id);
                Yii::app()->functions->updateOption("merchant_distance_type", 'km', $insert_id);
                Yii::app()->functions->updateOption("merchant_timezone", 'Asia/Kolkata', $insert_id);
                Yii::app()->functions->updateOption("merchant_minimum_order_pickup", 200, $insert_id);
                Yii::app()->functions->updateOption("merchant_latitude", 22.7258984, $insert_id);
                Yii::app()->functions->updateOption("merchant_longtitude", 75.8873889, $insert_id);
                Yii::app()->functions->updateOption("merchant_information", "<p style=\"margin-top: 5px; margin-bottom: 15px; padding: 0px; border: 0px; outline: 0px; font-size: 14.6667px; vertical-align: baseline; line-height: 1.7em; white-space: pre-wrap; clear: left; color: rgb(85, 85, 85); font-family: Lato, sans-serif; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\"><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">The&nbsp;</span><b style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">foodpanda</b><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">&nbsp;group is a global mobile food delivery marketplace headquartered in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Berlin\" title=\"Berlin\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">Berlin</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Germany\" title=\"Germany\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">Germany</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">, and operating in 24 countries and territories, including&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/India\" title=\"India\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">India</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Pakistan\" title=\"Pakistan\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">Pakistan</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Russia\" title=\"Russia\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">Russia</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Bangladesh\" title=\"Bangladesh\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">Bangladesh</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Hong_Kong\" title=\"Hong Kong\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">Hong Kong</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">&nbsp;and&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Singapore\" title=\"Singapore\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; line-height: 22.4px; white-space: normal; background-image: none; background-color: rgb(255, 255, 255); background-position: initial;\">Singapore</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.4px; white-space: normal;\">. The service allows users to select from local restaurants and place orders via the mobile application as well as the website. The company has partnered with over 40,000 restaurants.</span></p>", $insert_id);
                Yii::app()->functions->updateOption("merchant_photo", "1454064057-307_royal-treat-hotel-ambrosia-vijay-nagar-indore.jpg", $insert_id);
                Yii::app()->functions->updateOption("default_order_status", "paid", $insert_id);
                Yii::app()->functions->updateOption("free_delivery_above_price", 500, $insert_id);
                Yii::app()->functions->updateOption("shipping_enabled", "", $insert_id);
                Yii::app()->functions->updateOption("merchant_holiday", "", $insert_id);
            } else {
                Yii::app()->functions->updateOption("merchant_minimum_order", 700, $insert_id);
                Yii::app()->functions->updateOption("merchant_tax", 10, $insert_id);
                Yii::app()->functions->updateOption("merchant_delivery_charges", 200, $insert_id);
                Yii::app()->functions->updateOption("stores_open_day", '["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]', $insert_id);
                Yii::app()->functions->updateOption("stores_open_starts", '{"monday":"10:00","tuesday":"10:00","wednesday":"10:00","thursday":"10:00","friday":"10:00","saturday":"10:00","sunday":"10:00"}', $insert_id);
                Yii::app()->functions->updateOption("stores_open_ends", '{"monday":"20:00","tuesday":"20:00","wednesday":"20:00","thursday":"20:00","friday":"16:00","saturday":"20:00","sunday":"16:00"}', $insert_id);
                Yii::app()->functions->updateOption("merchant_delivery_estimation", '1 hours', $insert_id);
                Yii::app()->functions->updateOption("merchant_delivery_miles", 20, $insert_id);
                Yii::app()->functions->updateOption("merchant_distance_type", 'km', $insert_id);
                Yii::app()->functions->updateOption("merchant_timezone", 'Asia/Kolkata', $insert_id);
                Yii::app()->functions->updateOption("merchant_minimum_order_pickup", 300, $insert_id);
                Yii::app()->functions->updateOption("merchant_latitude", 22.7251752, $insert_id);
                Yii::app()->functions->updateOption("merchant_longtitude", 75.87752109, $insert_id);
                Yii::app()->functions->updateOption("merchant_information", "", $insert_id);
                Yii::app()->functions->updateOption("merchant_photo", "1454565171-radisson_n.jpg", $insert_id);
                Yii::app()->functions->updateOption("default_order_status", "paid", $insert_id);
                Yii::app()->functions->updateOption("free_delivery_above_price", 600, $insert_id);
                Yii::app()->functions->updateOption("shipping_enabled", "", $insert_id);
                Yii::app()->functions->updateOption("merchant_holiday", "", $insert_id);
            }
        }
    }
    
    

}
