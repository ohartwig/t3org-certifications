<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Ole Hartwig <o.hartwig@web-vision.de>, web-vision gmbh
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 *
 * @package certifications
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Certifications_Domain_Model_Certificate extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * certificationDate
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $certificationDate;

    /**
     * expirationDate
     *
     * @var DateTime
     */
    protected $expirationDate;

	/**
	 * allowListing
	 *
	 * @var boolean
	 */
	protected $allowListing = FALSE;

	/**
	 * expired
	 *
	 * @var boolean
	 */
	protected $expired = FALSE;

	/**
	 * certificateType
	 *
	 * @var Tx_Certifications_Domain_Model_CertificateType
	 */
	protected $certificateType;

	/**
	 * Returns the certificationDate
	 *
	 * @return DateTime $certificationDate
	 */
	public function getCertificationDate() {
		return $this->certificationDate;
	}

	/**
	 * Sets the certificationDate
	 *
	 * @param DateTime $certificationDate
	 * @return void
	 */
	public function setCertificationDate($certificationDate) {
		$this->certificationDate = $certificationDate;
	}

    /**
     * Returns the expirationDate
     *
     * @return DateTime $expirationDate
     */
    public function getExpirationDate() {
        return $this->expirationDate;
    }

    /**
     * Sets the expirationDate
     *
     * @param DateTime $expirationDate
     * @return void
     */
     public function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
     }

	/**
	 * Returns the allowListing
	 *
	 * @return boolean $allowListing
	 */
	public function getAllowListing() {
		return $this->allowListing;
	}

	/**
	 * Sets the allowListing
	 *
	 * @param boolean $allowListing
	 * @return void
	 */
	public function setAllowListing($allowListing) {
		$this->allowListing = $allowListing;
	}

	/**
	 * Returns the boolean state of allowListing
	 *
	 * @return boolean
	 */
	public function isAllowListing() {
		return $this->getAllowListing();
	}

	/**
	 * Returns the expired
	 *
	 * @return boolean $expired
	 */
	public function getExpired() {
		return $this->expired;
	}

	/**
	 * Sets the expired
	 *
	 * @param boolean $expired
	 * @return void
	 */
	public function setExpired($expired) {
		$this->expired = $expired;
	}

	/**
	 * Returns the boolean state of expired
	 *
	 * @return boolean
	 */
	public function isExpired() {
		return $this->getExpired();
	}

	/**
	 * Returns the certificateType
	 *
	 * @return Tx_Certifications_Domain_Model_CertificateType $certificateType
	 */
	public function getCertificateType() {
		return $this->certificateType;
	}

	/**
	 * Sets the certificateType
	 *
	 * @param Tx_Certifications_Domain_Model_CertificateType $certificateType
	 * @return void
	 */
	public function setCertificateType(Tx_Certifications_Domain_Model_CertificateType $certificateType) {
		$this->certificateType = $certificateType;
	}

}
?>