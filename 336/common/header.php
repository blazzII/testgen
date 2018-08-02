<header>
<div class="flex-container-logo">
                <div class="pageLogo">
                    <a href="/"><img class="acmelogo" src="/images/site/logo.gif" alt="ACME logo"/></a>
                </div>
                <div class="accountArea">
<?php 
    if(!empty($_SESSION)) {
        if(isset($_SESSION['clientData']['clientFirstname'])){
            echo "<div>Welcome " . $_SESSION['clientData']['clientFirstname'] . "&nbsp;&nbsp;&nbsp;</div>";
        }
        if(isset($_SESSION['loggedin'])) {
            if($_SESSION['loggedin']) {
                echo '<a href="/accounts/index.php?action=myAccount" class="logButton"><img class="accntFolderImg" src="/images/site/account.gif" alt="picture of folder"/>My Account</a><a href="/accounts/index.php?action=logout" class="logButton">Log Out</a>';
            }
        } else {
            echo '<a href="/accounts/index.php?action=loginPage" class="logButton"><img class="accntFolderImg" src="/images/site/account.gif" alt="picture of folder"/>Log In</a>';
        } 
    } else {
        if(isset($cookieFirstname)){
            echo "<div>Welcome Back, $cookieFirstname&nbsp;&nbsp;&nbsp;</div>";
        }
        echo '<a href="/accounts/index.php?action=loginPage" class="logButton"><img class="accntFolderImg" src="/images/site/account.gif" alt="picture of folder"/>Log In</a>';
    }
?>
                </div>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/nav.php'; ?>
</header>