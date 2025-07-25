<?php

$clink = "class_mgmt.php?sel=" . $classid;
$slink = "class_joincode.php?sel=" . $classid;
$tlink = "class_voucher.php?sel=" . $classid;
$cilink = "class_inventory.php?sel=" . $classid;
$selink = "class_settings.php?sel=" . $classid;

echo "
<nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='home_educator.php'>ClassCash</a>
                <div class='navbar-brand'>" . $classname . "</div>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                        <li class='nav-item'>
                            <a href='" . $clink . "' class='nav-link'><span class='material-symbols-outlined'>assignment_ind</span> Students</a>
                        </li>
                        <li class='nav-item'>
                            <a href='" . $slink . "' class='nav-link'><span class='material-symbols-outlined'>group_add</span> Join Link</a>
                        </li>
                        <li class='nav-item'>
                            <a href='" . $tlink . "' class='nav-link'><span class='material-symbols-outlined'>payments</span> Vouchers</a>
                        </li>
                        <li class='nav-item'>
                            <a href='" . $cilink . "' class='nav-link'><span class='material-symbols-outlined'>shopping_bag</span> Class Inventory</a>
                        </li>
                        <li class='nav-item'>
                            <a href='" . $selink . "' class='nav-link'><span class='material-symbols-outlined'>settings</span> Settings</a>
                        </li>
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                Me
                            </a>
                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <li><a class='dropdown-item' href='logout.php'>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><br>
";
?>
