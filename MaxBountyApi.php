<?php

use SoapClient;

/**
 * MaxBounty Simple API PHP
 *
 * @author Luis Henrique Justin <contato@2labs.com.br>
 */
class MaxBountyApi {

    private $urlWSDL = "http://www.maxbounty.com/api.cfc?wsdl";
    private $sc = null;
    private $user;
    private $password;
    private $keyStr;

    public function __construct($user, $password) {
        $this->sc = new SoapClient($this->urlWSDL);
        $this->user = $user;
        $this->password = $password;
        $this->keyStr = $this->getKey();
    }

    private function getKey() {
        $loginDetails = array('user' => $this->user, 'password' => $this->password);
        return $this->sc->getKey($loginDetails);
    }

    public function campingList() {
        die("Not Implemented");
    }

    public function campaignInfo($offerId) {
        $params = array('keyStr' => $this->keyStr->return, 'offerId' => $offerId);
        $result = $this->sc->campaignInfo( $params)->return;
        return $this->resultParser($result)[0];
    }

    public function getCampaignCreatives($offerId) {
        die("Not Implemented");
    }

    public function getTodayStats($offerId = "0") {
        $params = array('keyStr' => $this->keyStr->return, 'offerId' => $offerId);
        $result = $this->sc->getTodayStats($params)->return;
        return $this->resultParser($result);
    }

    public function getYesterdayStats($offerId = "0") {
        $params = array('keyStr' => $this->keyStr->return, 'offerId' => $offerId);
        $result = $this->sc->getYesterdayStats($params)->return;
        return $this->resultParser($result);
    }

    public function getMonthToDateStats($offerId = "0") {
        $params = array('keyStr' => $this->keyStr->return, 'offerId' => $offerId);
        $result = $this->sc->getMonthToDateStats($params)->return;
        return $this->resultParser($result);
    }

    public function getLastMonthStats($offerId = "0") {
        $params = array('keyStr' => $this->keyStr->return, 'offerId' => $offerId);
        $result = $this->sc->getLastMonthStats($params)->return;
        return $this->resultParser($result);
    }

    public function getDateRangeStats($offerId = "0", $startDate, $endDate) {
        die("Not Implemented");
    }

    public function getTodaySubIDStats($subId = "") {
        die("Not Implemented");
    }

    public function getYesterdaySubIDStats($subId = "") {
        die("Not Implemented");
    }

    public function getMonthToDateSubIDStats($subId = "") {
        die("Not Implemented");
    }

    public function getLastMonthSubIDStats($subId = "") {
        die("Not Implemented");
    }

    public function getDateRangeSubIDStats($subId = "", $startDate, $endDate) {
        die("Not Implemented");
    }

    public function getTodaySubIDDetails($subId = "") {
        die("Not Implemented");
    }

    public function getYesterdaySubIDDetails($subId = "") {
        die("Not Implemented");
    }

    public function getMonthToDateSubIDDetails($subId = "") {
        die("Not Implemented");
    }

    public function getLastMonthSubIDDetails($subId = "") {
        die("Not Implemented");
    }

    public function getDateRangeSubIDDetails($subId = "", $startDate, $endDate) {
        die("Not Implemented");
    }

    public function getTodayLeads() {
        $params = array('keyStr' => $this->keyStr->return);
        $result = $this->sc->getTodayLeads($params)->return;

        return $this->resultParser($result);
    }

    public function getYesterdayLeads() {
        $params = array('keyStr' => $this->keyStr->return);
        $result = $this->sc->getYesterdayLeads($params)->return;

        return $this->resultParser($result);
    }

    public function getMonthToDateLeads() {
        $params = array('keyStr' => $this->keyStr->return);
        $result = $this->sc->getMonthToDateLeads($params)->return;

        return $this->resultParser($result);
    }

    public function getLastMonthLeads() {
        $params = array('keyStr' => $this->keyStr->return);
        $result = $this->sc->getLastMonthLeads($params)->return;

        return $this->resultParser($result);
    }

    public function getDateRangeLeads($startDate, $endDate) {
        die("Not Implemented");
    }

    public function getAffiliateCap($offerId) {
        die("Not Implemented");
    }

    private function resultParser($result) {
        $processed = [];
        $i = 0;
        if (gettype($result) === "array") {
            foreach ($result as $key => $value) {
                $data = $value->entries;
                $tmp = [];
                foreach ($data as $v) {
                    $tmp[$v->key] = $v->value;
                }
                $processed[$i] = $tmp;
                $tmp = null;
                $i++;
            }
        } elseif (gettype($result) === "object") {
            $data = $result->entries;
            $tmp = [];
            foreach ($data as $v) {
                $tmp[$v->key] = $v->value;
            }
            $processed[$i] = $tmp;
        }

        return $processed;
    }

    private function vardump($dump) {
        echo '<pre>', var_dump($dump), '</pre>';
    }

}
