<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Kai Ole Hartwig <o.hartwig@web-vision.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class tx_certifications_tcemain
 */
class Tx_Certifications_Hooks_Tcemain {

    /**
     * @param $incomingFieldArray
     * @param $table
     * @param $id
     * @param $parentObj
     */
    public function processDatamap_preProcessFieldArray(&$incomingFieldArray, $table, $id, &$parentObj) {
        // Preview link
        if ($table === 'fe_users') {
            if (
                $incomingFieldArray['tx_extbase_type'] === 'Tx_Certifications_FeUsers'
                && $incomingFieldArray['username'] == ''
                && $incomingFieldArray['password'] == ''
            ) {
                //'generate' Username
                $incomingFieldArray['username'] = '#'.$incomingFieldArray['first_name'].'.'.$incomingFieldArray['last_name'];

                //Set 'name'
                if ($incomingFieldArray['name'] == '') {
                    $incomingFieldArray['name'] = $incomingFieldArray['first_name'].' '.$incomingFieldArray['last_name'];
                }

                //generate randome password
                $incomingFieldArray['password'] = $this->generateRandomString();

                if ($incomingFieldArray['usergroup'] == '') {
                    $incomingFieldArray['usergroup'] = 30;
                }
            }

        }
        if ($table === 'tx_certifications_domain_model_certificate') {
            if ($incomingFieldArray['expiration_date'] == '' && $incomingFieldArray['expired'] === '0') {
                $certDate = $incomingFieldArray['certification_date'];
                $incomingFieldArray['expiration_date'] = ($certDate + (3 * 31556926));
            }
        }
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-_?/()&%$§<>#+';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wv_ogreader/Classes/Hooks/Tcemain.php']) {
    require_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wv_ogreader/Classes/Hooks/Tcemain.php']);
}
