
<?php
session_start();
if(!isset($_SESSION['userdata'])) {
  header("location: ../");
  exit;
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($userdata['status'] == 0) {
  $status = '<b style="color:red">Not Voted</b>';
}
else{
  $status = '<b style="color:green"> Voted</b>';
}


?>


<head>

  <title>Document</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div>
    <button>Logout</button>
<button>Back</button>
<h1>Online Voting System</h1>

<div id="profile">
<img src="../uploads/<?php echo $_SESSION['userdata']['photo']; ?>" height="200" width="200" alt=""><br><br>
<b>Name: <?php echo $_SESSION['userdata']['name']; ?></b><br><br>
<b>Mobile: <?php echo $_SESSION['userdata']['mobile']; ?></b><br><br>
<b>Address: <?php echo $_SESSION['userdata']['address']; ?></b><br><br>
<b>Status: <?php echo $status; ?></b><br><br>
</div>
<div id="groups">
<?php
if($_SESSION['groupsdata']) {
 for($i = 0; $i < count($_SESSION['groupsdata']); $i++) {
    ?>
    <div>
      <img src="../uploads/<?php echo $_SESSION['groupsdata'][$i]['photo']; ?>" alt="" height="100" width="100" >
      <b>Group Name: <?php echo $_SESSION['groupsdata'][$i]['name']; ?></b><br>
      <b>Votes: <?php echo $_SESSION['groupsdata'][$i]['votes']; ?>  </b><br>
      <form action="../api/vote.php" method="POST" >
        <input type="hidden" name="gvotes" value="<?php echo $_SESSION['groupsdata'][$i]['votes']; ?>">
        <input type="submit" value="Vote" id="votebtn">
      </form>
    </div>
    <?php
 }
}
?>

</div>

  </div>
</body>
