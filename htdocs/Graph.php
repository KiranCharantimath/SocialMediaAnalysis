<?php
$var_value = $_GET['varname'];

$mysqli = mysqli_connect("localhost", "root", "", "Youtube");
$res = mysqli_query($mysqli, "SELECT VideoTitle,ChannelTitle,PublishedDate,Views,Likes,Dislikes,Favourites,PositiveComments,NegativeComments from YTVideoDetails where ImageUrl='$var_value'");
    $VideoTitle="";
    $ChannelTitle="";
    $PublishedDate="";
    $Views="";
    $Likes="";
    $Dislikes="";
    $Favourites="";
    $PositiveComments="";
    $NegativeComments="";
while ($row = mysqli_fetch_assoc($res)){
      $VideoTitle = $row['VideoTitle'];
      $ChannelTitle = $row['ChannelTitle'];
      $PublishedDate = $row['PublishedDate'];
      $Views = $row['Views'];
      $Dislikes = $row['Dislikes'];
      $Likes = $row['Likes'];
      $Favourites = $row['Favourites'];
      $PositiveComments = $row['PositiveComments'];
      $NegativeComments = $row['NegativeComments'];
}
?>
<?php
   $res = mysqli_query($mysqli, "SELECT CurrentDate,Views,Likes,Dislikes,PositiveComments,NegativeComments from YoutubePastData where VideoId = (select VideoId from YTVideoDetails where ImageUrl='$var_value')");
   $currentDate=array();
   $views=array();
   $likes=array();
   $dislikes=array();
   $positiveComments=array();
   $negativeComments=array();
   while ($row = mysqli_fetch_assoc($res)){
        array_push($currentDate,$row['CurrentDate']);
        array_push($views,$row['Views']);
        array_push($likes,$row['Likes']);
        array_push($dislikes,$row['Dislikes']);
        array_push($positiveComments,$row['PositiveComments']);
        array_push($negativeComments,$row['NegativeComments']);
    }
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music Analytics Page</title>
    <style>
        img{
            margin-left:36%;
        }
        canvas#MusicPlatformAnalysis{
            top: -91%;
            left: 84%;

    margin-left: 45%;

        }
        #youtubeAnalytics{
               width: 621px;
    margin-left: -28%;
        }
        #mychart{
            position: relative;
            margin-left: 115%;
            margin-top: 86px;
        }
        p{
            margin-left: 38%;
            font-size: 37px;
            position: relative;
            
        }
        .chart-container{
            margin-left: 10%;
            margin-top: 6%;
        }
        table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 35%;
  table-layout: fixed;
      margin-top: -30%;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
#TodayAnalytics{
    position: relative;
    top: -66%;
    margin-top: -25%;
    left: 60%;
}
#RadioAnalysis{
    margin-left: 45%;
}    
    </style>
</head>
<body>

        <img src=<?php echo $var_value?> alt>
        <p>Youtube Analytics</p>
        <div class="chart-container" style="position: relative; width:621px">
            <canvas id="youtubeAnalytics" style="width: 621px;margin-left: -20%;display: block;" width="519" height="259"></canvas>
        </div>
        <table id="TodayAnalytics">
                
                    <thead>
                        <tr>
                            <th scope="col" id="...">Today's Analysis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Channel Title</td>
                            <td><?php echo $ChannelTitle ?></td>
                        </tr>
                        <tr>
                            <td>Video Title</td>
                            <td><?php echo $VideoTitle ?></td>
                        </tr>
                        <tr>
                            <td>Published Date</td>
                            <td><?php echo $PublishedDate ?></td>
                        </tr>
                        <tr>
                            <td>Views</td>
                            <td><?php echo $Views ?></td>            
                        </tr>
                        <tr>
                            <td>Likes</td>
                            <td><?php echo $Likes ?></td>
                        </tr>
                        <tr>
                            <td>DisLikes</td>
                            <td><?php echo $Dislikes ?></td>
                        </tr>
                        <tr>
                            <td>Favourites</td>
                            <td><?php echo $Favourites ?></td>
                        </tr>
                        <tr>
                            <td>Positive Comments</td>
                            <td><?php echo $PositiveComments ?></td>
                        </tr>
                        <tr>
                            <td>Negative Comments</td>
                            <td><?php echo $NegativeComments ?></td>
                        </tr>
                
                
                
                    </tbody>    
                </table>
        <br>
          <br>
        <br><br>
        <br><br>
        <div id="MusicRadioAnalytics">
        <p>Music Platform Analytics</p>
        <div class="chart-container" style="position: relative;width:621px">
            <canvas id="MusicPlatformAnalysis" width="621px"></canvas>
        </div>
        <br>
        <br>
        <br>
        <p>Radio Analytics</p>
        <div class="chart-container" style="position: relative;width:621px">
            <canvas id="RadioAnalysis" width="621px" ></canvas>
        </div>
        </div>
        <br>
        <br>
        <br>
        <script type="text/javascript">
            var currentDate = <?php echo json_encode($currentDate); ?>;
            var views = <?php echo json_encode($views); ?>;
            for(var i=0; i<views.length; i++) {
                //Let's take the constant factor as 2
                views[i] = views[i] / 100000;
            }
            var likes = <?php echo json_encode($likes); ?>;
            for(var i=0; i<likes.length; i++) {
                //Let's take the constant factor as 2
                likes[i] = likes[i] / 1000;
            }
            var dislikes = <?php echo json_encode($dislikes); ?>;
            for(var i=0; i<dislikes.length; i++) {
                //Let's take the constant factor as 2
                dislikes[i] = dislikes[i] / 100;
            }
            var positiveComments = <?php echo json_encode($positiveComments); ?>;
            var negativeComments = <?php echo json_encode($negativeComments); ?>;
            
        </script>
        <script>
        var ctx = document.getElementById("youtubeAnalytics").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: currentDate,
                datasets: [{
                    label: 'Views',
                    data: views,
                    backgroundColor: [
                       'rgba(0,0,0,0)'
                    ],
                    borderColor: [
                        'rgba(12, 11, 11,1)'
                    
                    ],
                    borderWidth: 1
                },{
                    label: 'Likes',
                    data: likes,
                    backgroundColor: [
                       'rgba(0,0,0,0)'
                    ],
                    borderColor: [
                        'rgba(11, 39, 245,1)'
                        
                    ],
                    borderWidth: 1
                },{
                    label: 'DisLikes',
                    data: dislikes,
                    backgroundColor: [
                       'rgba(0,0,0,0)'
                    ],
                    borderColor: [
                        'rgba(204, 0, 0,1)'
                    
                    ],
                    borderWidth: 1
                },{
                    label: 'Positive Comments',
                    data: positiveComments,
                    backgroundColor: [
                        'rgba(0,0,0,0)'
                    ],
                    borderColor: [
                        'rgba(251, 228, 0,1)'
                        
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Negative Comments',
                    data: negativeComments,
                    backgroundColor: [
                      'rgba(0,0,0,0)'
                    ],
                    borderColor: [
                        'rgba(251, 0, 209,1)'
                        
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var ptx = document.getElementById("MusicPlatformAnalysis").getContext('2d');
        var myChart = new Chart(ptx, {
            type: 'line',
            data: {
                labels: currentDate,
                datasets: [{
                    label: 'Music Platform Top 10',
                    data: [1,5,9,8,2,2,4],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        var atx = document.getElementById("RadioAnalysis").getContext('2d');
        var myChart = new Chart(atx, {
            type: 'line',
            data: {
                labels: currentDate,
                datasets: [{
                    label: 'Radio Top 10',
                    data: [9, 7, 9, 6, 7, 8],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        </script>
</body>
</html>
