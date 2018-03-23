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
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>css/welcome-page-css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    <div class="pull-right">
        <p><a href="Logout" class="btn btn-danger">Sign Out </a></p>
    </div>
    <div class="page-header">
        <h1>Welcome, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>.
    </div>
 

    <div class="row top-buffer">
        <div class="col-sm-6">
            <select id="yearSelect" class="form-control" onchange="loadQuestions()">
            <option value="">Select year</option>
            <option value="1999">1999</option>
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
            <option value="2003">2003</option>
            <option value="2004">2004</option>
            <option value="2005">2005</option>
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            </select>
        </div>

        <div class="col-sm-6">
            <select id="instituteSelect" class="form-control" onchange="loadQuestions()">
                <option value="">Select institute</option>
                <option value="Alfred">Alfred</option>
                <option value="CRGH">CRGH</option>
                <option value="Concord">Concord</option>
                <option value="DeltaMed">DeltaMed</option>
                <option value="Dunedin">Dunedin</option>
                <option value="EH">EH</option>
                <option value="Eastern Health">Eastern Health</option>
                <option value="GCUH">GCUH</option>
                <option value="Greenslopes">Greenslopes</option>
                <option value="Liverpool">Liverpool</option>
                <option value="NeuroMCQs">NeuroMCQs</option>
                <option value="Newcastle">Newcastle</option>
                <option value="PAH">PAH</option>
                <option value="PassingTheFRACPWritten">PassingTheFRACPWritten</option>
                <option value="Physed">Physed</option>
                <option value="RACP">RACP</option>
                <option value="RACR">RACR</option>
                <option value="RNSH">RNSH</option>
                <option value="RPA">RPA</option>
                <option value="RPAH">RPAH</option>
                <option value="Royal Adelaide">Royal Adelaide</option>
                <option value="St George">St George</option>
                <option value="StG">StG</option>
                <option value="StV">StV</option>
                <option value="TPCH">TPCH</option>
                <option value="Townsville">Townsville</option>
                <option value="Westmead">Westmead
                <option value="Westmed">Westmed</option>
            </select>
        </div>
    </div>

    <div class="row top-buffer">
        <div class="col-sm-6">
        <select id="specialtySelect" class="form-control" onchange="loadQuestions()">
            <option value="">Select specialty</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Clinical pharmacology">Clinical pharmacology</option>
            <option value="Dermatology">Dermatology</option>
            <option value="Endocrinology">Endocrinology</option>
            <option value="Ethics and law">Ethics and law</option>
            <option value="Evidence based medicine">Evidence based medicine</option>
            <option value="Gastroenterology">Gastroenterology</option>
            <option value="General medicine">General medicine</option>
            <option value="Genetics">Genetics</option>
            <option value="Geriatrics">Geriatrics</option>
            <option value="Gynaecology">Gynaecology</option>
            <option value="Haematology">Haematology</option>
            <option value="Immunology">Immunology</option>
            <option value="Infectious diseases">Infectious diseases</option>
            <option value="Intensive care">Intensive care</option>
            <option value="Nephrology">Nephrology</option>
            <option value="Neurology">Neurology</option>
            <option value="Oncology">Oncology</option>
            <option value="Ophtalmology">Ophtalmology</option>
            <option value="Palliative care">Palliative care</option>
            <option value="Pedigree">Pedigree</option>
            <option value="Pharmacology">Pharmacology</option>
            <option value="Physiology">Physiology</option>
            <option value="Psychiatry">Psychiatry</option>
            <option value="Radiology">Radiology</option>
            <option value="Respiratory">Respiratory</option>
            <option value="Rheumatology">Rheumatology</option>
            <option value="Sleep medicine">Sleep medicine</option>
            <option value="Statistics">Statistics</option>
            <option value="Toxicology">Toxicology</option>
        </select>
        </div>

        <div class="col-sm-6">
            <select id="typeSelect" class="form-control" onchange="loadQuestions()">
                <option value="">Select type</option>
                <option value="Exam">Exam</option>
                <option value="Joke">Joke</option>
                <option value="Journal Club">Journal Club</option>
                <option value="MCQ Book">MCQ Book</option>
                <option value="MCQBook">MCQBook</option>
                <option value="Recall">Recall</option>
                <option value="Revision course">Revision course</option>
                <option value="Trial">Trial</option>
                <option value="TrialExam">TrialExam</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-sm-6">
            <select id="tagSelect" class="form-control" onchange="loadQuestions()">
                <option value="">Select tag</option>
                <option value="2018ActuallyWorking">2018ActuallyWorking</option>
                <option value="2018Paper2">2018Paper2</option>
                <option value="Broken">Broken</option>
                <option value="Challenge">Challenge</option>
                <option value="DailyExam-02-02-18">DailyExam-02-02-18</option>
                <option value="DailyExam-03-02-18">DailyExam-03-02-18</option>
                <option value="DailyExam-04-02-18">DailyExam-04-02-18</option>
                <option value="DailyExam-05-02-18">DailyExam-05-02-18</option>
                <option value="DailyExam-06-02-18">DailyExam-06-02-18</option>
                <option value="DailyExam-07-02-18">DailyExam-07-02-18</option>
                <option value="DailyExam-08-02-18">DailyExam-08-02-18</option>
                <option value="DailyExam-09-02-18">DailyExam-09-02-18</option>
                <option value="DailyExam-10-02-18">DailyExam-10-02-18</option>
                <option value="DailyExam-11-02-18">DailyExam-11-02-18</option>
                <option value="DailyExam-12-02-18">DailyExam-12-02-18</option>
                <option value="DailyExam-12-35-18">DailyExam-12-35-18</option>
                <option value="DailyExam-13-02-18">DailyExam-13-02-18</option>
                <option value="DailyExam-13-32-18">DailyExam-13-32-18</option>
                <option value="DailyExam-14-01-18">DailyExam-14-01-18</option>
                <option value="DailyExam-14-02-18">DailyExam-14-02-18</option>
                <option value="DailyExam-15-01-18">DailyExam-15-01-18</option>
                <option value="DailyExam-15-02-18">DailyExam-15-02-18</option>
                <option value="DailyExam-16-01-18">DailyExam-16-01-18</option>
                <option value="DailyExam-16-02-18">DailyExam-16-02-18</option>
                <option value="DailyExam-17-01-18">DailyExam-17-01-18</option>
                <option value="DailyExam-17-02-18">DailyExam-17-02-18</option>
                <option value="DailyExam-18-01-18">DailyExam-18-01-18</option>
                <option value="DailyExam-19-01-18">DailyExam-19-01-18</option>
                <option value="DailyExam-20-01-18">DailyExam-20-01-18</option>
                <option value="DailyExam-20-02-18">DailyExam-20-02-18</option>
                <option value="DailyExam-21-01-18">DailyExam-21-01-18</option>
                <option value="DailyExam-21-02-18">DailyExam-21-02-18</option>
                <option value="DailyExam-22-01-18">DailyExam-22-01-18</option>
                <option value="DailyExam-22-02-18">DailyExam-22-02-18</option>
                <option value="DailyExam-23-01-18">DailyExam-23-01-18</option>
                <option value="DailyExam-23-02-18">DailyExam-23-02-18</option>
                <option value="DailyExam-24-01-18">DailyExam-24-01-18</option>
                <option value="DailyExam-24-02-18">DailyExam-24-02-18</option>
                <option value="DailyExam-25-01-18">DailyExam-25-01-18</option>
                <option value="DailyExam-25-02-18">DailyExam-25-02-18</option>
                <option value="DailyExam-26-01-18">DailyExam-26-01-18</option>
                <option value="DailyExam-26-02-18">DailyExam-26-02-18</option>
                <option value="DailyExam-27-01-18">DailyExam-27-01-18</option>
                <option value="DailyExam-28-01-18">DailyExam-28-01-18</option>
                <option value="DailyExam-29-01-18">DailyExam-29-01-18</option>
                <option value="DailyExam-30-01-18">DailyExam-30-01-18</option>
                <option value="DailyExam-31-01-18">DailyExam-31-01-18</option>
                <option value="DailyExam-32-02-18">DailyExam-32-02-18</option>
                <option value="DailyExam-BrownTown">DailyExam-BrownTown</option>
                <option value="DailyExam-EpicRhubarb">DailyExam-EpicRhubarb</option>
                <option value="DailyExam-FrodosRing">DailyExam-FrodosRing</option>
                <option value="DailyExam-HappyNewYear">DailyExam-HappyNewYear</option>
                <option value="DailyExam-MyLifeForAiur">DailyExam-MyLifeForAiur</option>
                <option value="DailyExam-Neurotoxin">DailyExam-Neurotoxin</option>
                <option value="DailyExam-PsychoticSloth">DailyExam-PsychoticSloth</option>
                <option value="DailyExam-SundaySpecial">DailyExam-SundaySpecial</option>
                <option value="DailyExam-SwissAlps">DailyExam-SwissAlps</option>
                <option value="DailyExam-SwissArmyKnife">DailyExam-SwissArmyKnife</option>
                <option value="DailyExam-SwissCheese">DailyExam-SwissCheese</option>
                <option value="DailyExam-SwissChocolate">DailyExam-SwissChocolate</option>
                <option value="DailyExam-SwissWatch">DailyExam-SwissWatch</option>
                <option value="DailyExam-TheCakeIsALie">DailyExam-TheCakeIsALie</option>
                <option value="DailyExam-TheGogglesDoNothing">DailyExam-TheGogglesDoNothing</option>
                <option value="LastWrittenExam">LastWrittenExam</option>
                <option value="LiverpoolTrial2018">LiverpoolTrial2018</option>
                <option value="RACPWritten2007">RACPWritten2007</option>
                <option value="Radiculopathy">Radiculopathy</option>
                <option value="RenalTubularAcidosis">RenalTubularAcidosis</option>
                <option value="StGeorgeTrial2018">StGeorgeTrial2018</option>
                <option value="coagulation">coagulation</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-sm-6">
            <p>Answered/Unanswered Filter:</p>
            <label class="radio-inline"><input type="radio" name="optradio" value="0">All</label>
            <label class="radio-inline"><input type="radio" name="optradio" value="1">Answered</label>
            <label class="radio-inline"><input type="radio" name="optradio" value="2">Unanswered</label>
        </div>
    </div>

    <div class="row top-buffer">
        <div class="col-sm-6 col-sm-offset-3">
            <input id="searchBar" type="text" name="search" placeholder="Search .." >
        </div>
    </div>

    <div class="row top-buffer">
        <div class="col-sm-2 col-sm-offset-1">
            <button type="button" class="btn btn-primary" onclick="resetSearch()">Reset Search/Filters</button>  
        </div>        
        <div class="col-sm-2 col-sm-offset-2">
            <button type="button" class="btn btn-primary" onclick="loadQuestions()">Search</button>
        </div>
        <div class="col-sm-2 col-sm-offset-1">
            <button type="button" class="btn btn-primary" onclick="loadQuestions()">Load All questions</button>
        </div>
    </div>

    <div class="row top-buffer">
        <button type="button" class="btn btn-primary" onclick="loadTest()">Start Test</button>
    </div>

    <input id="base_url" type="hidden" value="<?php echo base_url();?>" placeholder="Search .." >
    

    <div id="searchResult" >

        <span id="searchCount" class="label label-success"></span>

        <div id="searchError" class="alert alert-danger">
            <strong>No questions found</strong>
        </div>

        <div class="ajax-loader">
            <img src="<?php echo base_url(); ?>static/preloader.gif"  style="padding-left:45%"/>
        </div>

        <ol class="questions">
        </ol> 
    </div>
</body>
</html>

<script type="text/javascript">
    var base_url = $("#base_url").val();
    var loadTestLink = base_url+'index.php/Question/loadQuestionPage/0/1';

$(document).ready(function(){
    $(".ajax-loader").hide();
    $("#searchError").hide();
});

$("input[name='optradio']").change(function(){
    loadQuestions();
    // Do something interesting here
});

function loadTest(){
    window.location = loadTestLink;
}

function resetSearch(){

    $('#searchBar').val("");
    $('#yearSelect').val('');
    $('#specialtySelect').val('');
    $('#instituteSelect').val('');
    $('#specialtySelect').val('');
    $('#typeSelect').val('');  
    $('input[name="optradio"][value=0]').prop('checked', 'checked');      
    loadQuestions();
}

// function loadQuestions(){

//     var base_url = $("#base_url").val();
//     queryUrl = '?';

//     if($('#yearSelect').val()!=""){
//         queryUrl+='year='+$('#yearSelect').val()+"&";
//     }

//     if($('#instituteSelect').val()!=""){
//         queryUrl+='source='+$('#instituteSelect').val()+"&";
//     }

//     if($('#tagSelect').val()!=""){
//         queryUrl+='tags='+$('#tagSelect').val()+"&";
//     }

//     if($('#specialtySelect').val()!=""){
//         queryUrl+='specialty='+$('#specialtySelect').val()+"&";
//     }

//     if($('#typeSelect').val()!=""){
//         queryUrl+='type='+$('#typeSelect').val()+"&";
//     }

//     //Check if Answered filter checked 
//     ansFilter = $('input[name=optradio]:checked').val();

//     if(ansFilter==null)
//         ansFilter = 0;


//     if(queryUrl=='?'){
//         loadQuestions(ansFilter);
//         return;
//     }
//     $(".ajax-loader").show();
//     $("#searchResult ol").empty();
//     $("#searchError").hide();
//     $.ajax({
//                 url: base_url + "index.php/question/getfilteredQuestions/"+ansFilter+queryUrl,
//                 type: "GET",
//                 success: function (res) {

//                     var obj = jQuery.parseJSON(res);
//                     if(obj.length==0){
//                         $("#searchError").show();
//                     }
//                     $("#searchCount").text(obj.length+" question(s) found");
//                     var i=0;
//                     $.each(obj, function(key,value) {
//                         if(i==0)
//                            loadTestLink = base_url+'index.php/Question/loadQuestionPage/'+ansFilter+'/'+value.question_id+'?filter=true&'+queryUrl.substr(1);
//                         i++;
//                         $("#searchResult ol").append('<li><a href="'+base_url+'index.php/Question/loadQuestionPage/'+ansFilter+'/'+value.question_id+'?filter=true&'+queryUrl.substr(1)+'">'+value.question+'</a></li><hr>');
//                     });

//                     $(".ajax-loader").hide();

//                 },

//             });

// }

function loadQuestions(){

    var base_url = $("#base_url").val();
    $(".ajax-loader").show();
    $("#searchResult ol").empty();
    $("#searchError").hide();


    //Check all the filters 

    // 1)Drop down filter

    queryUrl = '?';

    if($('#yearSelect').val()!=""){
        queryUrl+='year='+$('#yearSelect').val()+"&";
    }

    if($('#instituteSelect').val()!=""){
        queryUrl+='source='+$('#instituteSelect').val()+"&";
    }

    if($('#tagSelect').val()!=""){
        queryUrl+='tags='+$('#tagSelect').val()+"&";
    }

    if($('#specialtySelect').val()!=""){
        queryUrl+='specialty='+$('#specialtySelect').val()+"&";
    }

    if($('#typeSelect').val()!=""){
        queryUrl+='type='+$('#typeSelect').val()+"&";
    }

    //2) (Un)Answered filter
    var ansFilter = $('input[name=optradio]:checked').val();

    if(ansFilter==null)
        ansFilter = 0;

    //3) Search
    var keyword = $('#searchBar').val();
    if(keyword!="")
        queryUrl=queryUrl+'search='+keyword;

    if(queryUrl=='?')
        queryUrl='';

    $.ajax({
                url: base_url + "index.php/question/getQuestionsFinal/"+ansFilter+"/"+queryUrl,
                type: "GET",
                success: function (res) {

                    var obj = jQuery.parseJSON(res);
                    if(obj.length==0){
                        $("#searchError").show();
                    }
                    
                    $("#searchCount").text(obj.length+" question(s) found");
                    
                    var i=0;
                    $.each(obj, function(key,value) {
                        if(i==0)
                           loadTestLink = base_url+'index.php/Question/loadQuestionPage/'+ansFilter+'/'+value.question_id+queryUrl;
                        i++;
                      $("#searchResult ol").append('<li><a href="'+base_url+'index.php/Question/loadQuestionPage/'+ansFilter+'/'+value.question_id+queryUrl+'">'+value.question+'</a></li><hr>');
                    });

                    $(".ajax-loader").hide();

                },

            });

}

// function search(){

//     var base_url = $("#base_url").val();
//     var keyword = $('#searchBar').val();
//     var ansFilter = $('input[name=optradio]:checked').val();

//     if(ansFilter==null)
//         ansFilter = 0;

//     if(keyword==""){
//         $("#searchResult ol").empty();
//         $("#searchError").hide();
//         $("#searchCount").text("Blank input/Search reset");

//         return;
//     }

//     $(".ajax-loader").show();

//     $.ajax({
//                 url: base_url + "index.php/question/searchQuestions/" + ansFilter+"/"+keyword,
//                 type: "GET",
//                 success: function (res) {
//                     $("#searchResult ol").empty();
//                     var obj = jQuery.parseJSON(res);
//                     if(obj.length==0){
//                         $("#searchError").show();
//                     }
                    
//                     var i=0;
//                     $("#searchCount").text(obj.length+" question(s) found");
                    
//                     $.each(obj, function(key,value) {

//                         if(i==0)
//                            loadTestLink = base_url+'index.php/Question/loadQuestionPage/'+ansFilter+'/'+value.question_id+'?search='+keyword;
//                         i++;
//                       $("#searchResult ol").append('<li><a href="'+base_url+'index.php/Question/loadQuestionPage/'+ansFilter+'/'+value.question_id+'?search='+keyword+'">'+value.question+'</a></li><hr>');
//                     });

//                     $(".ajax-loader").hide();

//                 },

//             });

// }

//http://localhost/physician.life/index.php/Question/loadQuestionPage/4
$('#searchBar').keypress(function (e) {
  var key = e.which;
 if(key == 13)  // the enter key code
  {
    loadQuestions(); 
  }
}); 
</script> 