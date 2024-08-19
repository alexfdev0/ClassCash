<?php

echo "
<nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='home_student.php'>ClassCash</a>
                <div class='navbar-brand'>" . $classname . "</div>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                        <li class='nav-item'>
                            <a href='" . $clink . "' class='nav-link'><span class='material-symbols-outlined'>account_circle</span> Class Profile</a>
                        </li>
                        <li class='nav-item'>
                            <a href='" . $slink . "' class='nav-link'><span class='material-symbols-outlined'>store</span> Shop</a>
                        </li>
                        <li class='nav-item'>
                            <a href='" . $tlink . "' class='nav-link'><span class='material-symbols-outlined'>currency_exchange</span> Transfer ClassCoins</a>
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
