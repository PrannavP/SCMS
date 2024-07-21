<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request Parts Update</title>
    <link rel="stylesheet" href="../../../../styles/manager-add-parts.css">
</head>
<body>
    <a href="../manager-service-requests.php" class="back-button" title="Go Back">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5"></path>
            <path d="M12 5l-7 7 7 7"></path>
        </svg>
    </a>
    <div class="container">
        <h1>Service Request Parts Update</h1>
        <form id="updateForm">
            <label for="requested_by">Select Request:</label>
            <select id="requested_by" name="requested_by">
                <option value="">Select a request</option>
                <?php include 'get_requests.php'; ?>
            </select>

            <div id="existingParts">
                <h3>Existing Parts:</h3>
                <ul id="existingPartsList"></ul>
            </div>

            <div id="partsContainer">
                <label for="parts">Select Part:</label>
                <select class="parts" name="parts[]">
                    <option value="">Select a part</option>
                    <?php include 'get_parts.php'; ?>
                </select>
            </div>

            <button type="button" id="addMore">Add More Parts</button>
            <div id="currentTotal">Current Total: Rs.<span id="totalValue">0 </span></div>
            <button type="submit">Update Parts and Price</button>
        </form>
    </div>
    <div id="popup" class="popup">
        <div class="popup-content">
            <p>Parts added</p>
        </div>
    </div>
    <!-- <script src="script.js"></script> -->
    <script src="../../../../scripts/manager-add-parts.js"></script>
</body>
</html>