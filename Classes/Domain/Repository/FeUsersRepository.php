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
class Tx_Certifications_Domain_Repository_FeUsersRepository extends Tx_Extbase_Domain_Repository_FrontendUserRepository {

    /**
     * @return array|Tx_Extbase_Persistence_QueryResultInterface
     */
    public function findAll() {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $result = $query
            ->matching(
                $query->equals('tx_extbase_type', 'Tx_Certifications_FeUsers')
            )
            ->execute();

        return $result;
    }

    /**
     * @param $letter
     * @return array|Tx_Extbase_Persistence_QueryResultInterface
     */
    public function findByFirstLetterOfLastName($letter) {
        $letter = strtoupper($letter);
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->setOrderings(array(
            'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
            'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
            'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
        ));

        $and = array(
            $query->equals('tx_extbase_type', 'Tx_Certifications_FeUsers'),
            $query->like('last_name',$letter.'%')
        );

        $query->matching($query->logicalAnd($and));

        $return = $query->execute();

        return $return;
    }

    /**
     * @param $sortby
     * @param $sorting
     * @return array|Tx_Extbase_Persistence_QueryResultInterface
     */
    public function findBySortBy($sortby,$sorting) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);

        if ($sortby ===  'country') {
            if ($sorting === 'asc') {
                $query->setOrderings(array(
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ));
            } elseif ($sorting === 'desc') {
                $query->setOrderings(array(
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ));
            }
        } elseif ($sortby === 'certificate') {
            if ($sorting === 'asc') {
                $query->setOrderings(array(
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ));
            } elseif ($sorting === 'desc') {
                $query->setOrderings(array(
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ));
            }
        }

        $and = array(
            $query->equals('tx_extbase_type', 'Tx_Certifications_FeUsers'),
        );

        $query->matching($query->logicalAnd($and));

        $return = $query->execute();

        return $return;
    }
}
?>