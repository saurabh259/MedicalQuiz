

<!-- Reminder : move JS to separate folder -->


<?php
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Screen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>css/question-page-css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    <div class="row">
        <div class="pull-right" style="margin-left: 0.5%;margin-right: 2%;margin-top: 1%">
            <p><a href="<?php echo base_url();?>index.php/Login/logout" Logout class="btn btn-danger">Sign Out</a></p>
        </div>

        <div class="pull-right" style="margin-top: 1%;">
            <p><a href="<?php echo base_url();?>index.php/Login/home" Logout class="btn btn-primary">Home</a></p>
        </div>
    </div>

    <br><br><br>
    <div class="row">
       <div class="questionNum col-lg-6 col-lg-offset-3 text-center"><em><h2>Question <?php echo $questionNo;?></h2></em></div>
    </div><br>

    <div class="col-sm-12">
        <div id="questionBody">
            <input id="question_id" type="hidden" value="<?php echo $questionObj->question_id ?>" >
            <?php echo $questionObj->question?><br>
        </div>
    </div>

    <div class="col-sm-6">
        <div id="options">
            <?php $counter=0;foreach ($optionsArray as $option) {
                $counter++;
                echo "<div class='radio'>";
                echo "<label>";
                echo "<input type='radio' name='response' value='",$option->option_id,"'>  ",$option->option;
                echo "</label>";
                echo "</div>";
            }
            ?>
        </div>


        <div class="col-lg-8 col-md-12 top-buffer">
            <button type="submit" class="btn btn-success margin-bottom" onclick="submitResponse(3)">Confident</button>
            <button type="submit" class="btn btn-info margin-bottom" onclick="submitResponse(2)">Probable</button>
            <button type="submit" class="btn btn-warning margin-bottom" onclick="submitResponse(1)">Maybe</button>
            <button type="submit" class="btn btn-danger margin-bottom" onclick="submitResponse(0)">No idea</button>
        </div>

        <div id="correctDiv" class="col-sm-6 top-buffer hidden" >
            <div id="correct-response" class="alert alert-danger">Correct answer is option <?php echo $correctOption+1;  if($questionObj->explanation!="") echo '<br><br>'.$questionObj->explanation; else echo '<br><br>No explanation found';?> 
            </div>
        </div>
    </div>

        
        <!-- <div class="pull-right"><button type="button" class="btn btn-default">Next Question</button></div>
        <div class="pull-left"><button type="button" class="btn btn-default">Prev Question</button></div>
    
         -->    

         <div id="pagination">
                <?php if ($pId!=-1)
                    echo '<div style="display: inline-block;margin-right:80%;margin-left:1%;"><a href = "',base_url(),'index.php/Question/loadQuestionPage/',$ansFilter,'/',$pId.$appendUrl,'"> <button type="button" class="btn btn-default">Prev Question</button> </a></div>';
                    else
                      echo '<div style="display: inline-block;margin-right:80%;margin-left:1%;"><a href = "',base_url(),'index.php/Login/home/"> <button type="button" class="btn btn-default">Back to home</button> </a></div>';  
                    ?>

                <?php if ($nId!=-1)
                    echo '<div style="display: inline-block"><a href = "',base_url(),'index.php/Question/loadQuestionPage/',$ansFilter,'/',$nId.$appendUrl,'"> <button type="button" class="btn btn-default">Next Question</button> </a></div>';
                    else
                      echo '<div style="display: inline-block"><a href = "',base_url(),'index.php/Login/home/"> <button type="button" class="btn btn-default">Proceed home</button> </a></div>';
                ?>
            </div>
    </div>                  
    <input id="base_url" type="hidden" value="<?php echo base_url();?>" >
    <input id="user_id" type="hidden" value="<?php echo $_SESSION['user_id'];?>" >
    <input id="correct_ans" type="hidden" value="<?php echo $questionObj->answer;?>" >
</body>
</html>

<script type="text/javascript">
    var base_url = $("#base_url").val();
    var user_id = $("#user_id").val();
    var question_id = $("#question_id").val();
    var correct_ans = $("#correct_ans").val().trim();


function submitResponse(confidence){

    var user_answer = $('input[name=response]:checked').val();
    
    //Check if radio buttons are all checked
    if ($('div#options:not(:has(:radio:checked))').length) {
        alert("Please select one of the options");
        return;
    }

    //Change the div-box color to green
    if(correct_ans==user_answer){
        $('#correct-response').removeClass('alert-danger');
        $('#correct-response').addClass('alert-success');

    }

    else{
        $('#correct-response').removeClass('alert-success');
        $('#correct-response').addClass('alert-danger');

    }

    //Submit user response to Db via ajax call here
    $.ajax({
                url: base_url + "index.php/response/submitResponse/",
                type: "POST",
                dataType : "json",
                data: {"user_id" : user_id,"question_id" : question_id ,"option_id":user_answer,"confidence":confidence},
                success: function (res) {
                }
            });

    // Show the correct answer
    $('#correctDiv').removeClass('hidden');
}

</script>