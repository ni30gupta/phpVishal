<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

$res = mysqli_query($con, "SELECT * from vote");


while ($rows = mysqli_fetch_assoc($res)) {
     $id  = $rows['id'];
?>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js">

     </script>
     <div id="root"></div>
     <script>
          function loadVote() {
               $.ajax({
                    url: 'loadVote.php',
                    type: 'post',
                    data: "",
                    success: function(getData) {
                         $('#root').html(getData);
                    }
               })
          }
          setInterval(() => {
               loadVote();
          }, 2000);
     </script>

     <!-- <form method="post">
          <div id="<?php echo $id; ?>"></div>
          <input type="button" onclick="voteSubmit(<?php echo $rows['id'] ?>, 'vote1' )" name="vote1" value="<?php echo $rows['vote1']; ?>"> (<span id="vote1_<?php echo $rows['id']; ?>"><?php echo $rows['vote1_count']; ?></span>) V/s

          <input type="button" onclick="voteSubmit(<?php echo $rows['id'] ?>, 'vote2' )" name="vote2" value="<?php echo $rows['vote2']; ?>"> (<span id="vote2_<?php echo $rows['id']; ?>"><?php echo $rows['vote2_count']; ?></span>)<br> <br>

     </form> -->


     <script>
          function voteSubmit(id, type) {
               $.ajax({
                    url: 'submit.php',
                    type: 'post',
                    data: "id=" + id + '&type=' + type,
                    success: function(result) {


                         newRes = $.parseJSON(result)
                         $(`#${id}`).html(newRes.msg);
                         if (newRes.vote) {

                              $(`#${type}_${id}`).html(newRes.vote)
                         }

                    }
               })
          }
     </script>
<?php } ?>