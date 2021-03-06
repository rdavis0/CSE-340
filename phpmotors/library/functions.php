<?php
    function checkEmail($clientEmail) {
        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $valEmail;
    }

    // Check the password for a minimum of 8 characters,
    // at least one 1 capital letter, at least 1 number and
    // at least 1 special character
    function checkPassword($clientPassword) {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }

    function isLoggedIn() {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] )
            return true;
        else
            return false;
    }

    // Build a navigations bar using the $classifications array
    function buildNavList() {
        $classifications = getClassifications();
        $navList = '<ul>';
        $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $classificationName = $classification['classificationName'];
            $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classificationName)
            ."' title='View our $classificationName product line'>$classificationName</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }

    // Build the classifications select list 
    function buildClassificationList($classifications){ 
        $classificationList = '<select name="classificationId" id="classificationList">'; 
        $classificationList .= "<option>Choose a Classification</option>"; 
        foreach ($classifications as $classification) { 
            $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
        } 
        $classificationList .= '</select>'; 
        return $classificationList; 
    }

    function buildVehiclesDisplay($vehicles){
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
            $formattedPrice = "$" . number_format($vehicle['invPrice'], 2);
            $vehDetailPath = "/phpmotors/vehicles/index.php?action=vehicleDetailView&invId=$vehicle[invId]";
            $dv .= '<li>';
            $dv .= "<div class='veh-img-container'>";
            $dv .= "<a href='$vehDetailPath'><img src='/phpmotors$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a></div>";
            $dv .= "<a href='$vehDetailPath'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
            $dv .= "<span>$formattedPrice</span>";
            $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
    }

    function buildVehicleDetailsDisplay($vehicle){
        $formattedPrice = "$" . number_format($vehicle['invPrice'], 2);
        $dv = "<div class='veh-details'>";
        $dv .= "<img src='/phpmotors$vehicle[invImage]' alt='$vehicle[invMake] $vehicle[invModel]'>";
        $dv .= "<div class='veh-info'>";
            $dv .= "<p class='veh-specs'>";
                $dv .= "<span class='veh-price'>$formattedPrice</span><br>";
                $dv .= "<span class='veh-color'>$vehicle[invColor]</span><br>";
                $dv .= "<span class='veh-stock'>$vehicle[invStock] in stock</span></p>";
            $dv .= "<p class='veh-desc'>$vehicle[invDescription]</p></div></div>";
        return $dv;
    }

    function buildReviewForm($invId, $client)  {
        $clientId = $client['clientId'];
        $screenName = substr($client['clientFirstname'], 0, 1) . $client['clientLastname'];
        $dv = "<form method='post' action='/phpmotors/reviews/' class='review-form'>";
        $dv .= "<h3>Leave a review</h3>";
        $dv .= "<label>Screen name <br>";
        $dv .= "<input name='screenname' type='text' readonly value=$screenName></label><br>";
        $dv .= "<label>Review <br>";
        $dv .= "<textarea name='reviewText' placeholder='Write your review here' required></textarea></label><br>";
        $dv .= "<input type='submit' class='btn' value='Submit'>";
        $dv .= "<input type='hidden' name='action' value='addReview'>";
        $dv .= "<input type='hidden' name='invId' value=$invId>";
        $dv .= "<input type='hidden' name='clientId' value=$clientId>";
        $dv .= "</form>";
        return $dv;
    }

    function buildReviewsDisplay($reviews) {
        $dv = "<div class='reviews-display'><ul>";
        foreach ($reviews as $review) {
            $dv .= "<li class='client-review'>";
            $dv .= "<p class='review-metadata'><span class='screenName'>$review[screenName]</span> wrote on ";
            $dv .= formatDate($review['reviewDate']) . "</p>";
            $dv .= "<p class='review-text'>$review[reviewText]</p>";
            $dv .= "</li>";
        }
        $dv .= "</ul></div>";
        return $dv;
    }

    function buildClientReviewsDisplay($clientReviews) {
        $dv = "<div class='client-reviews-container'>";
        $dv .= "<ul>";
        foreach ($clientReviews as $r) {
            $invId = $r['invId'];
            $dv .= "<li class='client-review'>";
            $dv .= "<span><a href='../vehicles?action=vehicleDetailView&invId=$invId'>" . $r['carName'] . "</a>";
            $dv .= "<br>" . (formatDate($r['reviewDate'])) . "</span>";
            $dv .= "<span class='review-manage-buttons'>";
            $dv .= "<a href='/phpmotors/reviews?action=editReviewView&reviewId=$r[reviewId]'>Edit</a> | "; 
            $dv .= "<a href='/phpmotors/reviews?action=deleteReviewView&reviewId=$r[reviewId]'>Delete</a>"; 
            $dv .= "</span></li>";
        }
        $dv .= "</ul></div>";
        return $dv;
    }

    function formatDate($date) {
        return date('j F, Y', strtotime($date));
    }
?>