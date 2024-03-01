<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../../index.html");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../styles/manager-dashboard.css">
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

                    <li class="nav-item nav-customer_requests"><a href="../manager-service-requests/manager-service-requests.php">Customer Requests</a></li>

                    <li class="nav-item nav-mechanics"><a href="../manager-mechanics/manager-mechanics.php">Mechanics</a></li>

                    <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li>

                    <li class="nav-item nav-inventory"><a href="../manager-inventory/manager-inventory.php">Inventory</a></li>

                    <li class="nav-item logout"><a href="../../../middlewares/logout.php">Logout</a></a></li>

                </ul>

            </div>

        </nav>

    </aside>

    <div class="user-profile">

        <p class="user-profile-text">
            <?php echo $_SESSION["manager"]["name"] ?>
        </p><br>

        <p class="user-profile-text">Manager</p>

    </div>

    <article class="dashboard">
        
        <h2>Dashboard</h2>

        <section class="recent-serivce-requests">

            <h4>Recent Service Requests</h4>

            <div class="service-requests">

                    <?php 
                    
                        require '../../../middlewares/connection.php';

                        $serviceCenter = $_SESSION["manager"]["service-center"];

                        // Query
                        $sql_query = "SELECT requested_by, model, requested_date, requested_time FROM service_request WHERE service_center = '$serviceCenter' AND servicing_status = 'Pending Approval'";

                        // Execute the query
                        $serviceRequests = mysqli_query($conn, $sql_query);

                        while($rows = mysqli_fetch_assoc($serviceRequests)){ 
                            
                    ?>

                    <div class="service-request">

                            <div class="left-column">

                                <p class="service-request_name"><?php echo $rows["requested_by"] ?></p><br>
                        
                                <p class="service-request_model"><?php echo $rows["model"] ?></p>

                            </div>

                            <div class="right-column">

                                <p class="service-request_date">Date: <?php echo $rows["requested_date"] ?></p><br>

                                <p class="service-request_time">Time: <?php echo $rows["requested_time"] ?></p>

                            </div>

                    </div>

                    <?php } ?>

            </div>

        </section>

        <section class="mechanics-section">

            <div class="mechanic-section-header">

                <h4>Mechanics</h4>

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
            
            <div class="mechanic-count">

				<p class="mechanic-count-number">
                    <?php  

                        $mechanic_count_query = "SELECT mechanic_id FROM mechanic WHERE service_center = '$serviceCenter'";

                        $result = mysqli_query($conn, $mechanic_count_query);
            
                        if(!$result){
                            echo "0";
                        };
            
                        // return number of rows in the table
                        $mechanic_row = mysqli_num_rows($result);
                        echo $mechanic_row;

                    ?>
                </p>

            </div>

        </section>

        <section class="drivers-section">

            <div class="driver-section-header">

                <h4>Drivers</h4>

            </div>

            <div class="driver-section-svg">

                <svg xmlns="http://www.w3.org/2000/svg" width="6em" height="6em" viewBox="0 0 48 48">
                    <g fill="currentColor">
                        <path d="M21 11a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1" />
                        <path fill-rule="evenodd" d="M33.364 18.52c-.363.285-.834.513-1.402.698a8 8 0 1 1-15.924 0c-.568-.185-1.039-.413-1.401-.698c-.47-.37-.785-.864-.822-1.458c-.035-.551.183-1.019.401-1.349a4.31 4.31 0 0 1 .76-.841c.14-.123.278-.232.406-.327c-.038-.205-.08-.453-.122-.74A26.73 26.73 0 0 1 15 10c0-.314.134-.548.196-.647c.078-.125.17-.232.254-.318c.167-.175.383-.353.62-.524c.48-.348 1.14-.739 1.924-1.105C19.557 6.676 21.704 6 24 6c2.297 0 4.443.677 6.006 1.406a12.03 12.03 0 0 1 1.924 1.105c.237.171.453.35.62.524c.084.086.176.193.254.318c.062.099.196.333.196.647c0 1.602-.13 2.9-.26 3.805c-.042.287-.084.535-.122.74c.128.095.267.204.407.327c.25.219.536.504.759.841c.219.33.436.798.402 1.35c-.037.593-.352 1.087-.822 1.457m-16.362-8.202c.015 1.348.127 2.438.238 3.2c.026.18.052.34.076.482h13.368c.025-.142.05-.303.076-.482c.11-.762.223-1.852.238-3.2a3.886 3.886 0 0 0-.241-.188c-.361-.261-.909-.59-1.597-.911C27.777 8.573 25.924 8 24 8s-3.777.573-5.16 1.219c-.688.321-1.236.65-1.596.91a3.886 3.886 0 0 0-.242.19M16.788 16l-.003.002a5.03 5.03 0 0 0-.495.376c-.178.156-.32.308-.406.44a.778.778 0 0 0-.055.093a.71.71 0 0 0 .044.037c.15.118.472.291 1.1.462c.124.034.257.066.399.098l.009.002c.502.111 1.12.21 1.873.288c1.067.111 2.41.184 4.088.2L24 18c3.227 0 5.314-.201 6.62-.49l.008-.002c.143-.032.276-.064.4-.098c.627-.17.95-.344 1.099-.462a.71.71 0 0 0 .044-.037a.782.782 0 0 0-.054-.093a2.348 2.348 0 0 0-.407-.44a5.018 5.018 0 0 0-.494-.376L31.212 16zm6.94 4c2.642 0 4.69-.14 6.26-.384a6 6 0 1 1-11.98.069c1.463.202 3.338.315 5.72.315m-7.65 18.877A8.07 8.07 0 0 0 16 40v1a1 1 0 0 1-1.864.504a2.99 2.99 0 0 1-2.203.259l-1.932-.518a3 3 0 0 1-2.12-3.674l.776-2.898a3 3 0 0 1 3.674-2.121l1.932.517c.672.18 1.23.575 1.618 1.091a9.987 9.987 0 0 1 8.12-4.16a9.987 9.987 0 0 1 8.116 4.158a2.987 2.987 0 0 1 1.616-1.088l1.932-.517a3 3 0 0 1 3.674 2.12l.777 2.899a3 3 0 0 1-2.122 3.674l-1.931.517a2.99 2.99 0 0 1-2.2-.256A1 1 0 0 1 32 41v-1a8.07 8.07 0 0 0-.078-1.123l-5.204 1.395a3 3 0 0 1-5.436 0zm5.042-.72A3.007 3.007 0 0 1 23 36.172v-4.11a8.009 8.009 0 0 0-6.397 4.886zm10.277-1.21A8.009 8.009 0 0 0 25 32.062v4.109c.904.32 1.61 1.06 1.88 1.987zm2.147-.72a1 1 0 0 1 .707-1.225l1.932-.518a1 1 0 0 1 1.224.707l.777 2.898a1 1 0 0 1-.707 1.225l-1.932.518a1 1 0 0 1-1.225-.708zm-21.73-1.743a1 1 0 0 0-1.226.707l-.776 2.897a1 1 0 0 0 .707 1.225l1.932.518a1 1 0 0 0 1.225-.707l.776-2.898A1 1 0 0 0 13.745 35zM25 39a1 1 0 1 1-2 0a1 1 0 0 1 2 0" clip-rule="evenodd" />
                    </g>
                </svg>

            </div>

            <div class="driver-count">

                <p class="driver-count-number">
                    <?php  

                        $driver_count_query = "SELECT mechanic_id FROM mechanic WHERE service_center = '$serviceCenter'";

                        $result = mysqli_query($conn, $driver_count_query);

                        if(!$result){
                            echo "0";
                        };

                        // return number of rows in the table
                        $driver_row = mysqli_num_rows($result);
                        echo $driver_row;

                    ?>
                </p>

            </div>

        </section>

    </article>
    
</body>
</html>