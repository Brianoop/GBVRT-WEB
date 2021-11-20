<title>GBVRT</title>
    
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="Gender Based Violence Reporting and Tracking System">
<meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
<link rel="shortcut icon" href="favicon.ico"> 

<!-- FontAwesome JS-->
<script defer src="{{ asset('dashboard_assets/plugins/fontawesome/js/all.min.js') }}"></script>

<!-- Custom CSS -->
<link  rel="stylesheet" href="{{ asset('dashboard_assets/css/custom-styles.css') }}">

<!-- App CSS -->  
<link id="theme-style" rel="stylesheet" href="{{ asset('dashboard_assets/css/portal.css') }}">

@if(Request::is('chat-detail'))

<style>

/* Chat containers */
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

/* Darker chat container */
.darker {
  border-color: #ccc;
  background-color: #ddd;
}

/* Clear floats */
.container::after {
  content: "";
  clear: both;
  display: table;
}

/* Style images */
.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

/* Style the right image */
.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

/* Style time text */
.time-right {
  float: right;
  color: #aaa;
}

/* Style time text */
.time-left {
  float: left;
  color: #999;
}

</style>

@endif