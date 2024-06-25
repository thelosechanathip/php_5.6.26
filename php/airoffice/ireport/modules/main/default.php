<?PHP
session_start();
include_once '../lib/config.inc.php';
$Db = new MySqlConn;

$Db->rule();
?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
  <li class="breadcrumb-item active">Dashboard</li>
</ol>

 <div class="alert alert-warning alert-dismissible fade show" role="alert">
 <strong> <?php replicate_status();?> </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
<div class="row">
 
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-white">      
        <h4 class="card-title"></h4>
        <p class="card-subtitle">Last 30 Days</p>
      </div>
      <div class="card__options">
        <a href="fixed-instructor-earnings.html" class="btn btn-sm btn-primary-outline"><i class="material-icons">trending_up</i></a>
      </div>
      <div class="card-block">
        <div class="chart" id="earnings-month" style="height:200px"></div>
      </div>
    </div>
    <div class="card">
      <div class="card-header bg-white">
        <h4 class="card-title">Latest Transactions</h4>
      </div>
      <div class="card__options">
        <a href="fixed-instructor-statement.html" class="btn btn-sm btn-primary-outline"><i class="material-icons">receipt</i></a>
      </div>
      <table class="table table-middle text-xs-center">
        <tbody>
          <tr>
            <td>
              <div class="tag tag-default">12 Jan 2015</div>
            </td>
            <td><a href="fixed-student-profile.html">Adrian Demian</a></td>
            <td><a href="fixed-instructor-invoice.html">#8734</a></td>
            <td>$89</td>
          </tr>
          <tr>
            <td>
              <div class="tag tag-default">12 Jan 2015</div>
            </td>
            <td><a href="fixed-student-profile.html">Adrian Demian</a></td>
            <td><a href="fixed-instructor-invoice.html">#6616</a></td>
            <td>$54</td>
          </tr>
            <tr>
            <td>
              <div class="tag tag-default">12 Jan 2015</div>
            </td>
            <td><a href="fixed-student-profile.html">Adrian Demian</a></td>
            <td><a href="fixed-instructor-invoice.html">#12638</a></td>
            <td>$13</td>
          </tr>
          <tr>
            <td>
              <div class="tag tag-default">12 Jan 2015</div>
            </td>
            <td><a href="fixed-student-profile.html">Adrian Demian</a></td>
            <td><a href="fixed-instructor-invoice.html">#12089</a></td>
            <td>$84</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-white">
        <div class="media">
          <div class="media-body">
            <h4 class="card-title">Sales today</h4>
            <p class="card-subtitle">by course</p>
          </div>
          <div class="media-right media-middle">
            <a class="btn btn-sm btn-primary-outline" href="fixed-instructor-earnings.html">Earnings</a>
          </div>
        </div>
      </div>
      <ul class="list-group list-group-fit mb-0">
        <li class="list-group-item">
          <div class="media">
            <div class="media-body media-middle">
              <a href="fixed-instructor-course-edit.html">Basics of HTML</a>
            </div>
            <div class="media-right media-middle">
              <div class="text-xs-center">
                <span class="tag tag-pill tag-primary">15</span>    
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="media">
            <div class="media-body media-middle">
              <a href="fixed-instructor-course-edit.html">Angular in Steps</a>
            </div>
            <div class="media-right media-middle">
              <div class="text-xs-center">
                <span class="tag tag-pill tag-success">50</span>    
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="media">
            <div class="media-body media-middle">
              <a href="fixed-instructor-course-edit.html">Bootstrap Foundations</a>
            </div>
            <div class="media-right media-middle">
              <div class="text-xs-center">
                <span class="tag tag-pill tag-warning">14</span>    
              </div>
            </div>
          </div>
        </li>
          <li class="list-group-item">
          <div class="media">
            <div class="media-body media-middle">
              <a href="fixed-instructor-course-edit.html">GitHub Basics</a>
            </div>
            <div class="media-right media-middle">
              <div class="text-xs-center">
                <span class="tag tag-pill tag-danger">14</span>   
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="card">
      <div class="card-header bg-white media">
        <div class="media-body media-middle">
          <h4 class="card-title">Latest Comment</h4>
        </div>
        <div class="media-right text-xs-right" style="min-width: 80px;">
          <a href="#" class="btn btn-primary-outline btn-sm"><i class="material-icons">keyboard_arrow_left</i></a>
          <a href="#" class="btn btn-primary-outline btn-sm"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
      </div>
      <div class="card-block media">
        <div class="float-xs-right">
          <small class="text-muted">27 min ago</small>  
        </div>
        <div class="media-left">
          <a href="#">
          
          </a>
        </div>
        <div class="media-body media-middle">
          <a href="fixed-instructor-profile.html">mosaicpro</a>
          <small class="text-muted"> on your <a href="fixed-instructor-course-edit.html">Github Basics</a> course</small>
          <p class="mb-0">How can I load Charts on a page?</p>
        </div>
      </div>
      <div class="card-footer">
        <input type="text" class="form-control" placeholder="Quick Reply">
      </div>
    </div>
  </div>
</div>