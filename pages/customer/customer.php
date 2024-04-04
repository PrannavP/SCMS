<?php

    require '../../middlewares/connection.php';
    require_once '../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isCustomerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: customer-login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/customer-dashboard.css">
</head>
<body>

    <?php // echo $_SESSION["manager"]["service-center"] ?>

    <!-- <p><?php /*echo $_SESSION["user_type"]*/ ?></p>
    <p><?php /*echo $_SESSION["manager"]["name"]*/ ?></p> -->
    <!-- <button><a href="../../middlewares/logout.php">Logout</a></button> -->

    <header>

        <h2>Service Center</h2>

    </header>

    <!-- side navigation bar --> 
    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home active"><a href="./dashboard.php">Home</a></li>

                    <li class="nav-item nav-customer_requests"><a href="../manager-service-requests/manager-service-requests.php">Requests History</a></li>

                    <li class="nav-item nav-mechanics"><a href="../manager-mechanics/manager-mechanics.php">Spare Parts</a></li>

                    <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Servicing Status</a></li>

                    <li class="nav-item nav-inventory"><a href="../manager-inventory/manager-inventory.php">Suggesion / Issues</a></li>

                    <li class="nav-item logout"><a href="../../middlewares/logout.php">Logout</a></a></li>

                </ul>

            </div>

        </nav>

    </aside>

    <div class="user-profile">

        <p class="user-profile-text">
            <?php echo $_SESSION["customer"]["name"] ?>
        </p><br>

        <p class="user-profile-text">Customer</p>

    </div>

    <article class="dashboard">
        
        <h2>Dashboard</h2>

        <section class="service-centers-container">

            <h4>Available Service Centers</h4>

            <div class="service-centers">

                    <?php 
                    
                        require '../../middlewares/connection.php';

                        // Query
                        $sql_query_to_get_service_centers = "SELECT `name`, `location`, `slots`, `contact_number` FROM servicecenter";

                        // Execute the query
                        $service_centers = mysqli_query($conn, $sql_query_to_get_service_centers);

                        while($rows = mysqli_fetch_assoc($service_centers)){ 
                            
                    ?>

                    <div class="service-center">

                            <div class="left-column">

                                <p class="service-center-name"><?php echo $rows["name"] ?></p><br>
                        
                                <p class="service-center-location"><?php echo $rows["location"] ?></p>

                            </div>

                            <div class="right-column">

                                <p class="service-center_slots">Slots: <?php echo $rows["slots"] ?></p><br>

                                <p class="service-center_contact">Contact: <?php echo $rows["contact_number"] ?></p>

                            </div>

                    </div>

                    <?php } ?>

            </div>

        </section>

        <section class="servicing-section">

            <div class="servicing-status-header">

                <h4>Service Status</h4>

            </div>  

            <div class="mechanic-section-svg">
                    
                <svg xmlns="http://www.w3.org/2000/svg" width="6em" height="6em" viewBox="0 0 32 32">
                    <g fill="currentColor">
                        <path d="M11.18 10.28c.15-.62.71-1.08 1.38-1.08c.69 0 1.27.49 1.4 1.15a.23.23 0 0 1-.23.28h-.08c.02-.08.03-.16.03-.24c0-.5-.4-.91-.91-.91a.913.913 0 0 0-.88 1.15h-.44c-.18 0-.32-.18-.27-.35m7.65 0c-.15-.62-.71-1.08-1.38-1.08c-.7 0-1.27.49-1.4 1.15c-.03.15.08.28.23.28h.08a.986.986 0 0 1-.03-.24a.9.9 0 0 1 .91-.91a.913.913 0 0 1 .88 1.15h.44c.18 0 .31-.17.27-.35" />
                        <path d="M13.29 10.38c0-.29-.23-.52-.52-.52a.526.526 0 0 0-.204.04a.16.16 0 0 1-.106.28a.16.16 0 0 1-.134-.073a.522.522 0 0 0-.016.513h.92c.04-.07.06-.15.06-.24m3.76-.485a.516.516 0 0 1 .65.725h-.92a.521.521 0 0 1 .026-.53a.16.16 0 1 0 .244-.195m-2.89 2.125l.53-1.71c.12-.38.65-.38.76 0l.53 1.71c.11.35-.15.71-.52.71h-.78c-.37 0-.63-.36-.52-.71m.84 1.66c-.54 0-1.05-.13-1.48-.36c-.15-.08-.3.09-.21.23c.36.55.98.92 1.69.92s1.33-.37 1.69-.92c.09-.14-.07-.3-.21-.23c-.43.23-.93.36-1.48.36" />
                        <path d="M27.497 25.507c.003.03.004.06.003.091v3.512a1.37 1.37 0 0 1-1.37 1.37h-.006a.462.462 0 0 1-.134.02H4a.5.5 0 0 1-.5-.5v-3.5a11.428 11.428 0 0 1 6.683-10.448a3.496 3.496 0 0 1-.135-.2a2.788 2.788 0 0 1-1.791-2.564v-.714a2.2 2.2 0 0 1 .3-3.546V7.779a5.671 5.671 0 0 1 .977-4.54a5.552 5.552 0 0 1 4.36-1.739h2.253a5.557 5.557 0 0 1 4.368 1.739a5.763 5.763 0 0 1 .969 4.623v1.172a2.2 2.2 0 0 1 .311 3.521v.733a2.74 2.74 0 0 1-1.59 2.483c-.072.122-.151.24-.235.355c.51.25 1 .535 1.467.856c-.162.304-.278.63-.344.969l-.008-.006a3.475 3.475 0 0 0 .945 3.122v3.453a1.3 1.3 0 0 1 .672-.273a.501.501 0 0 1 .128-.017h.7v-3.144c0-.1-.06-.2-.15-.25a2.513 2.513 0 0 1-1.35-1.991v-.45a2.48 2.48 0 0 1 1.3-1.969c.19-.1.43.04.43.26v1.56c0 .41.32.74.73.75c.42.01.76-.34.76-.76v-1.55c0-.22.24-.35.43-.25c.78.42 1.31 1.25 1.32 2.18c0 .95-.53 1.78-1.32 2.2c-.09.05-.15.15-.15.25v1.085a1.503 1.503 0 0 1 1.96 1.428v1.854zm-7.537-8.262a9.91 9.91 0 0 0-.46-.233v4.068c0 .867-.968 1.361-1.668.87l-.02-.015l-2.724-2.353a.135.135 0 0 0-.176 0l-2.724 2.353l-.02.014a1.058 1.058 0 0 1-1.668-.869v-4.072c-.145.068-.289.14-.43.214v5.368c0 .23.18.41.41.41h9.07c.23 0 .41-.18.41-.41zM8 18.657A10.44 10.44 0 0 0 4.5 26.5v3H8zm18.49 5.53v-.609c0-.274-.226-.5-.5-.5a.504.504 0 0 0-.46.306v.804zm-3.66 5.293h3.3a.37.37 0 0 0 .37-.37v-3.508a1.184 1.184 0 0 1-.007-.074a.37.37 0 0 0-.363-.298h-3.2a.507.507 0 0 1-.1.01c-.157 0-.267.122-.27.242v.007a.25.25 0 0 0 .117.215a.5.5 0 0 1-.004.835a.245.245 0 0 0-.113.201c0 .09.043.157.103.195a.5.5 0 0 1 .01.844a.245.245 0 0 0-.113.201c0 .09.043.157.103.195a.5.5 0 0 1 .014.841a.274.274 0 0 0-.117.228c.006.118.115.236.27.236M12.508 17.198a4.462 4.462 0 0 1-1.008-.55v4.432c0 .02.005.03.008.036a.058.058 0 0 0 .023.02a.06.06 0 0 0 .03.007a.048.048 0 0 0 .02-.005l2.483-2.144a2.56 2.56 0 0 1-1.556-1.796M8.92 10.59c0 .646.524 1.17 1.17 1.17l.483-.002l.115 1.751A3.475 3.475 0 0 0 14.12 16.5h1.9a3.467 3.467 0 0 0 3.432-2.99l.107-1.718l.43-.036a1.17 1.17 0 0 0 .712-2.01a.5.5 0 0 1-.088-.076a1.163 1.163 0 0 0-.48-.225l-.422-.089l.027-.44a1.5 1.5 0 0 1-.994-.104a.274.274 0 0 1-.402.075l.158-.204l-.158.203l-.002-.001l-.017-.012a2.085 2.085 0 0 0-.381-.198a2.264 2.264 0 0 0-1.1-.143a.274.274 0 0 1-.168-.51A7.723 7.723 0 0 0 15 7.84c-.613 0-1.17.071-1.667.18a.274.274 0 0 1-.165.512a2.265 2.265 0 0 0-1.405.292a1.4 1.4 0 0 0-.076.049l-.017.012l-.002.002a.274.274 0 0 1-.404-.079c-.28.135-.585.176-.876.132l.028.432l-.47.057a1.16 1.16 0 0 0-.458.158a.505.505 0 0 1-.27.223c-.185.207-.298.48-.298.78m2.748-1.703l-.16-.208zm-.428-.303l-.096-.174l.097.172zm2.88 8.916c-.14 0-.279-.006-.416-.02a1.557 1.557 0 0 0 2.579.012a4.483 4.483 0 0 1-.263.008zm1.815 1.493l2.485 2.145a.048.048 0 0 0 .019.005a.06.06 0 0 0 .03-.007a.058.058 0 0 0 .023-.02a.064.064 0 0 0 .008-.036v-4.332a4.44 4.44 0 0 1-1.025.51a2.579 2.579 0 0 1-1.54 1.735m2.563-12.737a8.26 8.26 0 0 0-6.967 0l-.004.002a6.027 6.027 0 0 0-1.411.91l.112.14c.16.196.436.247.648.129l.002-.001a8.574 8.574 0 0 1 4.142-1.053c1.898 0 3.331.605 4.142 1.053h.002a.5.5 0 0 0 .634-.123l.002-.003l.114-.141a6.376 6.376 0 0 0-1.416-.913M13.7 25.74c0-.71-.58-1.29-1.29-1.29h-1.45c-.71 0-1.29.58-1.29 1.29c0 .71.58 1.29 1.29 1.29h1.45c.72 0 1.29-.57 1.29-1.29" />
                    </g>
                </svg>

            </div>
            
            <div class="status-section">

				<p class="status-text">
                    <?php  
                        $customer_email = $_SESSION["customer"]["email"];

                        $servicing_status_query = "SELECT `servicing_status` FROM service_request WHERE `email`='$customer_email'";

                        $servicing_status;

                       $result = mysqli_query($conn, $servicing_status_query);

                       if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $servcing_status = $row["servicing_status"];
                        }
                       }else{
                        echo "no results found";
                       };

                       echo $servcing_status;

                    ?>
                </p>

            </div>

        </section>

    </article>
    
</body>
</html>