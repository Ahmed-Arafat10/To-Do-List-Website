<?php
/*
*****************************
Ahmed Mohamed Yousry 18190046
*****************************
*/
$Host = "localhost";
$User = "root";
$Password = "";
$DataBase = "to-do-list";
$ConnectDataBase = mysqli_connect($Host, $User, $Password, $DataBase); //Build-in Function
// if($ConnectDataBase) echo "Done Connecting To DataBase";
// else echo "Failed Connoting To DataBase";

function print_message($text, $type)
{
    if ($type == "Danger") {
        echo "<div  style='text-align:center;margin-bottom:0' class='alert alert-danger alert-dismissible fade show' role='alert'>
    " . $text . "
   </div>";
    } else {
        echo "<div  style='text-align:center;margin-bottom:0' class='alert alert-success alert-dismissible fade show' role='alert'>
            " . $text . "
  </div>";
    }
}

if (isset($_POST['SubmitBTN'])) {
    $Note = $_POST['Note'];
    $InsertQuery = "INSERT INTO `list_table` VALUES(NULL,'$Note',0)";
    $ExecuteQuery = mysqli_query($ConnectDataBase, $InsertQuery);

    if ($ExecuteQuery) print_message("Done Inserting Note", "normal");

    else echo "NOOO";
} else {
    if (isset($_GET['Delete'])) {
        $ID = $_GET['Delete'];
        $DeleteQuery = "DELETE FROM `list_table` WHERE id =  $ID";
        if ($ID != -1) {
            $ExecuteQuery = mysqli_query($ConnectDataBase, $DeleteQuery);
            if ($ExecuteQuery) print_message("Done Deleting Note", "Danger");
            else echo "NOOO";
        }
    } else {
        if (isset($_GET['UpdateState'])) {
            $ID = $_GET['UpdateState'];
            $UpdateQuery = "UPDATE `list_table` SET isdone = 1 WHERE id =  $ID";
            $ExecuteQuery = mysqli_query($ConnectDataBase, $UpdateQuery);
            if ($ExecuteQuery) print_message("Done Updating Note State", "normal");
            else echo "NOOO";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-List</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/AboutMe.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">

</head>

<body>
<button id="myBtn"><a href="#NNAAVV" style="color:black">Top</a></button>
<!-- NavBar Start -->
<nav id="NNAAVV">
    <div class="img-container1">
        <a href="index.php"><img style="border-radius: 15px;" src="Pic/list.png" height="75" width="75" alt=""></a>

        <h1><span class="span1">To-</span><span class="span2">Do-</span><span class="span3">List</span></h1>

    </div>
    <div class="img-container2">
        <ul class="nav-ul">
            <li class="nav-li"><a href="#">More Projects</a></li>
            <li class="nav-li"><a href="#">About Project</a></li>
            <li class="nav-li"><a href="#">About Me</a></li>
        </ul>
    </div>
</nav>
<!-- NavBar End -->

<!-- Form Start -->
<fieldset style="color:burlywood">
    <div>
        <legend>JUST Enter Note You Want To Save</legend>
    </div>

    <form method="POST">
        <!-- <label for="">Note</label> -->
        <textarea required name="Note" placeholder="Enter Note Here!"></textarea>

        <button class="BTNN text-center" type="submit" name="SubmitBTN">Save Note</button>

    </form>

</fieldset>
<!-- Form End -->

<!-- Table Tag Start -->
<table>
    <tr>
        <thead>
        <th>No.</th>
        <th>Note</th>
        <th colspan="2">Action</th>
        </thead>
    </tr>
    <?php
    $SelectQuery = "SELECT * FROM `list_table` ORDER BY isdone , Note";
    $ExecuteQuery = mysqli_query($ConnectDataBase, $SelectQuery);
    $i = 0;
    foreach ($ExecuteQuery as $FetchData) {
        $i++;
        ?>
        <tr>
            <td> <?php echo $i ?> </td>
            <?php if ($FetchData['isdone'] == 1) : ?>
                <td>
                    <del><?php echo $FetchData['Note'] ?></del>
                </td>
            <?php else : ?>
                <td><?php echo $FetchData['Note'] ?></td>
            <?php endif; ?>
            <td><a href="./index.php?UpdateState=<?php echo $FetchData['id'] ?>"><img src="Pic/Done.png" height="40"
                                                                                      width="40" alt=""></a></td>
            <td><a href="./index.php?Delete=<?php echo $FetchData['id'] ?>"><img src="Pic/Delete.png" height="40"
                                                                                 width="40" alt=""></a></td>
        </tr>
    <?php } ?>
</table>
<!-- Table Tag End -->

<!-- Middle Me Container Start -->
<div class="Me-Container">
    <p style="text-align: justify;" class="Me-Par">Peter Quill : [Pointing guns at Stark and Parker] Everybody stay
        where you are, chill the eff out!
        [to Iron Man]
        Peter Quill : I'm gonna ask you this one time: where is Gamora?
        Tony Stark : Yeah, I'll do you one better: WHO'S Gamora?
        Drax : I'll do YOU one better: WHY is Gamora?
        Peter Quill : Tell me where the girl is, or I swear to you, I'm gonna french-fry this little freak!
        [puts his gun to Spider-Man's head]
        Tony Stark : Let's do it! You shoot my guy and I'll blast him! Let's go!
        [points his blaster in Drax's face]
        Drax : Do it, Quill! I can take it.
        Mantis : No, he can't take it!
        Dr. Stephen Strange : She's right, you can't.
        Peter Quill : Oh yeah? You don't wanna tell me where she is? That's fine, I'll kill all three of you and I'll
        beat it out of Thanos myself!
        [to Spider-Man]
        Peter Quill : Starting with you!
        Dr. Stephen Strange : Wait, what? Thanos? Alright, let me ask you this one time: what master do you serve?
        Peter Quill : What master do I serve? What am I supposed to say, Jesus?
        Tony Stark : You're from Earth?
        Peter Quill : I'm not from Earth, I'm from Missouri.
    </p>
    <div class="CARD">
        <div class="front">
            <header>
                <img src="./Pic/ME.jpg" alt="My pic">
            </header>
            <h3>Ahmed Arafat</h3>
            <p>Hello there, I'm Ahmed Arafat .. I'm C++ Developer Who Loves Technology & Computer .. I'm Currently An
                Instructor At ICPC FCI-HU Community, I'm Learning Web Development + Designing, It's Really So Funny &
                Totally Easier Than Problem Solving & Algorithms !</p>
            <span>Hover Me</span>
        </div>
        <div class="back">
            <ul>
                <li>Facebook: Ahmed Arafat</li>
                <li>Insagram: Ahmed Arafat</li>
                <li>Youtube: Ahmed Arafat</li>
                <li>linkedin: Ahmed Moahmed Yousry</li>
                <li>Github: Ahmed-Arafat10</li>
            </ul>
        </div>
    </div>
</div>
<!-- Middle Me Container End -->

<p class="Quote">Today's Quote : Be The Change That You Wish Yo See In The World</p>

<!-- Footer Start -->

<footer class="container-no-gutters">
    <div class="row">
        <div class="col-4">
            <div class="left-part-footer">
                <div class="info-footer">
                    <img src="./Pic/location.png" height="25" width="25" alt="">
                    <p>Cairo, Egypt</p>
                </div>
                <div class="info-footer">
                    <img src="./Pic/phone.png" height="25" width="25" alt="">
                    <p>01145352685</p>
                </div>
                <div class="info-footer">
                    <img src="./Pic/email.png" height="25" width="25" alt="">
                    <p><a style="color:wheat" href="mailto:ahmedmoyousry.bis@gmail.com">ahmedmoyousry.bis@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="h1-part-footer">
                <h1 style="font-family: 'Tangerine', serif;"><span style="color: black;">A</span>rafat</h1>
            </div>
            <div class="mid-part-footer">
                <p>All Copyrights Are reserved To Ahmed Arafat &copy; 2021 <br> :) اللي هو انا يعني</p>
            </div>
        </div>
        <div class="col-4">
            <div class="right-part-footer">
                <h4>About This Project</h4>
                <p>I Build This Project Using Pure Html , CSS , PHP , SQL for my Practical Exam For E-Commerce
                    Course</p>
                <a href="https://www.facebook.com/AhmedArafat01" target="_blank"> <img class="ICONIMG"
                                                                                       src="./Pic/Facebookicon.png"
                                                                                       height="40" width="40"
                                                                                       alt=""></a>
                <a href="https://www.instagram.com/ahmedarafat__/" target="_blank"> <img class="ICONIMG"
                                                                                         src="./Pic/instagram.png"
                                                                                         height="40" width="40" alt=""></a>
                <a href="https://www.linkedin.com/in/ahmed-mohamed-yousry-0101/" target="_blank"> <img class="ICONIMG"
                                                                                                       src="./Pic//linkedin.png"
                                                                                                       height="40"
                                                                                                       width="40"
                                                                                                       alt=""></a>
                <a href="https://github.com/Ahmed-Arafat10/" target="_blank"> <img class="ICONIMG"
                                                                                   src="./Pic/githubicon.png"
                                                                                   height="40" width="40" alt=""></a>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/swiper.min.js"></script>
</body>
</html>