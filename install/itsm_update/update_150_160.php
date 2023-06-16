<?php
/**
 * ---------------------------------------------------------------------
 * ITSM-NG
 * Copyright (C) 2022 ITSM-NG and contributors.
 *
 * https://www.itsm-ng.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of ITSM-NG.
 *
 * ITSM-NG is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * ITSM-NG is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ITSM-NG. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */

/**
 * Update ITSM-NG from 1.5.0 to 1.6.0
 *
 * @return bool for success (will die for most error)
 **/
function update150to160() {
    /** @global Migration $migration */
    global $DB, $migration;

    $current_config   = Config::getConfigurationValues('core');
    $updateresult     = true;
    $ADDTODISPLAYPREF = [];

    $migration->displayTitle(sprintf(__('Update to %s'), '1.6.0'));

    if(!$DB->fieldExists('glpi_users', 'access_font')) {
        $query = "INSERT INTO `glpi_configs` (`context`, `name`, `value`) VALUES ('core', 'cas_ssl', '1')";
        $DB->queryOrDie($query, "erreur lors de la mise a jour de la table de glpi_configs".$DB->error());
    }

    // ************ Keep it at the end **************
    $migration->executeMigration();
    return $updateresult;
}
