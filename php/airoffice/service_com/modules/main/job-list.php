
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>

                <li>
                    <a href="#">More Pages</a>
                </li>
                <li class="active">Inbox</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Tables
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Static &amp; Dynamic Tables
                    </small>
                </h1>
            </div><!-- /.page-header -->  
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="col-xs-12">

                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th class="detail-col">Details</th>
                                        <th>Domain</th>
                                        <th>Price</th>
                                        <th class="hidden-480">Clicks</th>

                                        <th>
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Update
                                        </th>
                                        <th class="hidden-480">Status</th>

                                        <th> 
                                            <button class=" text-center btn btn-xs btn-danger" data-toggle="modal" 
                                                    data-target="#exampleModal">
                                                <i class="ace-icon fa fa-plus bigger-120"></i>
                                            </button></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td class="center">
                                            <div class="action-buttons">
                                                <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                    <i class="ace-icon fa fa-angle-double-down"></i>
                                                    <span class="sr-only">Details</span>
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#">ace.com</a>
                                        </td>
                                        <td>$45</td>
                                        <td class="hidden-480">3,330</td>
                                        <td>Feb 12</td>

                                        <td class="hidden-480">
                                            <span class="label label-sm label-warning">Expiring</span>
                                        </td>

                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-warning">
                                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                                </button>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                <span class="blue">
                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="detail-row">
                                        <td colspan="8">
                                            <div class="table-detail">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2">
                                                        <div class="text-center">
                                                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="assets/images/avatars/profile-pic.jpg" />
                                                            <br />
                                                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                <div class="inline position-relative">
                                                                    <a class="user-title-label" href="#">
                                                                        <i class="ace-icon fa fa-circle light-green"></i>
                                                                        &nbsp;
                                                                        <span class="white">Alex M. Doe</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-7">
                                                        <div class="space visible-xs"></div>

                                                        <div class="profile-user-info profile-user-info-striped">
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Username </div>

                                                                <div class="profile-info-value">
                                                                    <span>alexdoe</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Location </div>

                                                                <div class="profile-info-value">
                                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                    <span>Netherlands, Amsterdam</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Age </div>

                                                                <div class="profile-info-value">
                                                                    <span>38</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Joined </div>

                                                                <div class="profile-info-value">
                                                                    <span>2010/06/20</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Last Online </div>

                                                                <div class="profile-info-value">
                                                                    <span>3 hours ago</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> About Me </div>

                                                                <div class="profile-info-value">
                                                                    <span>Bio</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <div class="space visible-xs"></div>
                                                        <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                        <div class="space-6"></div>

                                                        <form>
                                                            <fieldset>
                                                                <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                            </fieldset>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="clearfix">
                                                                <label class="pull-left">
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"> Email me a copy</span>
                                                                </label>

                                                                <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                                    Submit
                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td class="center">
                                            <div class="action-buttons">
                                                <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                    <i class="ace-icon fa fa-angle-double-down"></i>
                                                    <span class="sr-only">Details</span>
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#">base.com</a>
                                        </td>
                                        <td>$35</td>
                                        <td class="hidden-480">2,595</td>
                                        <td>Feb 18</td>

                                        <td class="hidden-480">
                                            <span class="label label-sm label-success">Registered</span>
                                        </td>

                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-warning">
                                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                                </button>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                <span class="blue">
                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="detail-row">
                                        <td colspan="8">
                                            <div class="table-detail">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2">
                                                        <div class="text-center">
                                                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="assets/images/avatars/profile-pic.jpg" />
                                                            <br />
                                                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                <div class="inline position-relative">
                                                                    <a class="user-title-label" href="#">
                                                                        <i class="ace-icon fa fa-circle light-green"></i>
                                                                        &nbsp;
                                                                        <span class="white">Alex M. Doe</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-7">
                                                        <div class="space visible-xs"></div>

                                                        <div class="profile-user-info profile-user-info-striped">
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Username </div>

                                                                <div class="profile-info-value">
                                                                    <span>alexdoe</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Location </div>

                                                                <div class="profile-info-value">
                                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                    <span>Netherlands, Amsterdam</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Age </div>

                                                                <div class="profile-info-value">
                                                                    <span>38</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Joined </div>

                                                                <div class="profile-info-value">
                                                                    <span>2010/06/20</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Last Online </div>

                                                                <div class="profile-info-value">
                                                                    <span>3 hours ago</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> About Me </div>

                                                                <div class="profile-info-value">
                                                                    <span>Bio</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <div class="space visible-xs"></div>
                                                        <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                        <div class="space-6"></div>

                                                        <form>
                                                            <fieldset>
                                                                <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                            </fieldset>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="clearfix">
                                                                <label class="pull-left">
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"> Email me a copy</span>
                                                                </label>

                                                                <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                                    Submit
                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td class="center">
                                            <div class="action-buttons">
                                                <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                    <i class="ace-icon fa fa-angle-double-down"></i>
                                                    <span class="sr-only">Details</span>
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#">max.com</a>
                                        </td>
                                        <td>$60</td>
                                        <td class="hidden-480">4,400</td>
                                        <td>Mar 11</td>

                                        <td class="hidden-480">
                                            <span class="label label-sm label-warning">Expiring</span>
                                        </td>

                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-warning">
                                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                                </button>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                <span class="blue">
                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="detail-row">
                                        <td colspan="8">
                                            <div class="table-detail">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2">
                                                        <div class="text-center">
                                                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="assets/images/avatars/profile-pic.jpg" />
                                                            <br />
                                                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                <div class="inline position-relative">
                                                                    <a class="user-title-label" href="#">
                                                                        <i class="ace-icon fa fa-circle light-green"></i>
                                                                        &nbsp;
                                                                        <span class="white">Alex M. Doe</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-7">
                                                        <div class="space visible-xs"></div>

                                                        <div class="profile-user-info profile-user-info-striped">
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Username </div>

                                                                <div class="profile-info-value">
                                                                    <span>alexdoe</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Location </div>

                                                                <div class="profile-info-value">
                                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                    <span>Netherlands, Amsterdam</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Age </div>

                                                                <div class="profile-info-value">
                                                                    <span>38</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Joined </div>

                                                                <div class="profile-info-value">
                                                                    <span>2010/06/20</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Last Online </div>

                                                                <div class="profile-info-value">
                                                                    <span>3 hours ago</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> About Me </div>

                                                                <div class="profile-info-value">
                                                                    <span>Bio</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <div class="space visible-xs"></div>
                                                        <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                        <div class="space-6"></div>

                                                        <form>
                                                            <fieldset>
                                                                <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                            </fieldset>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="clearfix">
                                                                <label class="pull-left">
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"> Email me a copy</span>
                                                                </label>

                                                                <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                                    Submit
                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td class="center">
                                            <div class="action-buttons">
                                                <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                    <i class="ace-icon fa fa-angle-double-down"></i>
                                                    <span class="sr-only">Details</span>
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#">best.com</a>
                                        </td>
                                        <td>$75</td>
                                        <td class="hidden-480">6,500</td>
                                        <td>Apr 03</td>

                                        <td class="hidden-480">
                                            <span class="label label-sm label-inverse arrowed-in">Flagged</span>
                                        </td>

                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-warning">
                                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                                </button>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                <span class="blue">
                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="detail-row">
                                        <td colspan="8">
                                            <div class="table-detail">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2">
                                                        <div class="text-center">
                                                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="assets/images/avatars/profile-pic.jpg" />
                                                            <br />
                                                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                <div class="inline position-relative">
                                                                    <a class="user-title-label" href="#">
                                                                        <i class="ace-icon fa fa-circle light-green"></i>
                                                                        &nbsp;
                                                                        <span class="white">Alex M. Doe</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-7">
                                                        <div class="space visible-xs"></div>

                                                        <div class="profile-user-info profile-user-info-striped">
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Username </div>

                                                                <div class="profile-info-value">
                                                                    <span>alexdoe</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Location </div>

                                                                <div class="profile-info-value">
                                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                    <span>Netherlands, Amsterdam</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Age </div>

                                                                <div class="profile-info-value">
                                                                    <span>38</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Joined </div>

                                                                <div class="profile-info-value">
                                                                    <span>2010/06/20</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Last Online </div>

                                                                <div class="profile-info-value">
                                                                    <span>3 hours ago</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> About Me </div>

                                                                <div class="profile-info-value">
                                                                    <span>Bio</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <div class="space visible-xs"></div>
                                                        <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                        <div class="space-6"></div>

                                                        <form>
                                                            <fieldset>
                                                                <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                            </fieldset>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="clearfix">
                                                                <label class="pull-left">
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"> Email me a copy</span>
                                                                </label>

                                                                <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                                    Submit
                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td class="center">
                                            <div class="action-buttons">
                                                <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                    <i class="ace-icon fa fa-angle-double-down"></i>
                                                    <span class="sr-only">Details</span>
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#">pro.com</a>
                                        </td>
                                        <td>$55</td>
                                        <td class="hidden-480">4,250</td>
                                        <td>Jan 21</td>

                                        <td class="hidden-480">
                                            <span class="label label-sm label-success">Registered</span>
                                        </td>

                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>

                                                <button class="btn btn-xs btn-warning">
                                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                                </button>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                <span class="blue">
                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="detail-row">
                                        <td colspan="8">
                                            <div class="table-detail">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2">
                                                        <div class="text-center">
                                                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="assets/images/avatars/profile-pic.jpg" />
                                                            <br />
                                                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                <div class="inline position-relative">
                                                                    <a class="user-title-label" href="#">
                                                                        <i class="ace-icon fa fa-circle light-green"></i>
                                                                        &nbsp;
                                                                        <span class="white">Alex M. Doe</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-7">
                                                        <div class="space visible-xs"></div>

                                                        <div class="profile-user-info profile-user-info-striped">
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Username </div>

                                                                <div class="profile-info-value">
                                                                    <span>alexdoe</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Location </div>

                                                                <div class="profile-info-value">
                                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                    <span>Netherlands, Amsterdam</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Age </div>

                                                                <div class="profile-info-value">
                                                                    <span>38</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Joined </div>

                                                                <div class="profile-info-value">
                                                                    <span>2010/06/20</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Last Online </div>

                                                                <div class="profile-info-value">
                                                                    <span>3 hours ago</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> About Me </div>

                                                                <div class="profile-info-value">
                                                                    <span>Bio</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <div class="space visible-xs"></div>
                                                        <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                        <div class="space-6"></div>

                                                        <form>
                                                            <fieldset>
                                                                <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                            </fieldset>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="clearfix">
                                                                <label class="pull-left">
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"> Email me a copy</span>
                                                                </label>

                                                                <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                                    Submit
                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.span -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">เพิ่มรายการ</h4>
                            </div>
                            <div class="modal-body">
                               
                                    <div class="row">
                                        <div class="col-xs-12">
                                        
                                            <!-- PAGE CONTENT BEGINS -->
 <form id="form_user" class="form-horizontal" role="form" >

                                            <div class="form-group ">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> วัน/เวลา ที่แจ้ง </label>

                                                <div class="col-sm-9">
                                                    <input type="text"  id="form-field-1"  class="col-xs-10 col-sm-5 datetimepicker" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">สถานที่ </label>

                                                <div class="col-sm-9">
                                                    <select  id="hospital_department" name="hospital_department"  class="col-xs-10 col-sm-5" />
                                                   <?php $sql=$Db->query('','hospital_department');
                                                   foreach($sql AS $row){
                                                    ?>
                                                    <option value="<?=$row['id'];?>">
                                                    <?=$row['name'];?>
                                                    </option>
                                                   <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> ชื่อ-สกุลผู้แจ้ง </label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="fullname" name="fullname" placeholder="Text Field" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">สาเหตุเบื้องต้น </label>

                                                <div class="col-sm-9">
                                                    <textarea id="form-field-1-1" placeholder="Text Field" class="form-control" /></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right">สถานะ</label>

                                                <div class="col-sm-9">
                                                    <span class="input-icon">
                                                        <select id="form-field-icon-1" />
                                                       </select>
                                                    </span>

                                                    <span class="input-icon input-icon-right">
                                                        <input type="text" id="form-field-icon-2" />
                                                        <i class="ace-icon fa fa-leaf green"></i>
                                                    </span>
                                                    <span class="input-icon input-icon-right">
                                                        <input type="text" id="form-field-icon-2" />
                                                        <i class="ace-icon fa fa-leaf green"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> ความเร่งด่วน </label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="form-field-1-1" placeholder="Text Field" class="form-control" />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right">ประเภทงาน</label>

                                                <div class="col-sm-9">
                                                    <span class="input-icon">
                                                        <select id="form-field-icon-1" />
                                                       </select>
                                                    </span>

                                                    <span class="input-icon input-icon-right">
                                                        <input type="text" id="form-field-icon-2" />
                                                        <i class="ace-icon fa fa-leaf green"></i>
                                                    </span>
                                                    <span class="input-icon input-icon-right">
                                                        <input type="text" id="form-field-icon-2" />
                                                        <i class="ace-icon fa fa-leaf green"></i>
                                                    </span>
                                                </div>
                                            </div>

                                           

                                            <div class="space-4"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>

                                               
                                               <span class="help-inline col-xs-12 col-sm-7">
                                                        <label class="middle">
                                                            <input class="ace" type="checkbox" id="id-disable-check" />
                                                            <span class="lbl"> มีการเปลี่ยนอุปกรณ์</span>
                                                        </label>
                                                    </span>
                                                </div>
                                         

                                            <div class="space-4"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> Readonly field </label>

                                                <div class="col-sm-9">
                                                    <input readonly="" type="text" class="col-xs-10 col-sm-5" id="form-input-readonly" value="This text field is readonly!" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <label class="middle">
                                                            <input class="ace" type="checkbox" id="id-disable-check" />
                                                            <span class="lbl"> Disable it!</span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="space-4"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-4">Relative Sizing</label>

                                                <div class="col-sm-9">
                                                    <input class="input-sm" type="text" id="form-field-4" placeholder=".input-sm" />
                                                    <div class="space-2"></div>

                                                    <div class="help-block" id="input-size-slider"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-5">Grid Sizing</label>

                                                <div class="col-sm-9">
                                                    <div class="clearfix">
                                                        <input class="col-xs-1" type="text" id="form-field-5" placeholder=".col-xs-1" />
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="help-block" id="input-span-slider"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right">Input with Icon</label>

                                                <div class="col-sm-9">
                                                    <span class="input-icon">
                                                        <input type="text" id="form-field-icon-1" />
                                                        <i class="ace-icon fa fa-leaf blue"></i>
                                                    </span>

                                                    <span class="input-icon input-icon-right">
                                                        <input type="text" id="form-field-icon-2" />
                                                        <i class="ace-icon fa fa-leaf green"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="space-4"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-6">Tooltip and help button</label>

                                                <div class="col-sm-9">
                                                    <input data-rel="tooltip" type="text" id="form-field-6" placeholder="Tooltip on hover" title="Hello Tooltip!" data-placement="bottom" />
                                                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="More details." title="Popover on hover">?</span>
                                                </div>
                                            </div>

                                            <div class="space-4"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Tag input</label>

                                                <div class="col-sm-9">
                                                    <div class="inline">
                                                        <input type="text" name="tags" id="form-field-tags" value="Tag Input Control" placeholder="Enter tags ..." />
                                                    </div>
                                                </div>
                                            </div>




                                            <input type="hidden" id="user-id" name="userid" value="">
</form>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-warning hidden btn-edit" onClick="dataList.editData($('#form_user').serializeArray())" >Edit User</button>
                                                <button type="button" class="btn btn-primary btn-add" onClick="dataList.addData($('#form_user').serializeArray())">Add User</button>
                                            </div>

                                        </div>
                                    </div>
                                

                            </div> 
                        </div>
                    </div>
                </div>
                <script type="text/javascript">

                    $('#exampleModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var chk_user_id = button.data('user-id') // 
                        if (chk_user_id != null) {
                            var modal = $(this);
                            dataList.getItem(chk_user_id).done(function (res) {
                                if (res != null && res.data.length > 0) {
                                    modal.find('.modal-title').text("Edit User");
                                    modal.find("#user-id").val(res.data[0].mem_id);
                                    modal.find("#user-name").val(res.data[0].mem_user);
                                    modal.find("#user-pass").val(res.data[0].mem_pass);
                                    modal.find("#user-fullname").val(res.data[0].mem_fullname);
                                    modal.find("#user-type").val(res.data[0].mem_type);
                                    modal.find(".btn-add").addClass("hidden");
                                    modal.find(".btn-edit").removeClass("hidden");
                                }
                            });
                        }
                    });
                    $('#exampleModal').on('hide.bs.modal', function (event) {
                       // $('#form_user')[0].reset();
                        var modal = $(this);
                        modal.find(".modal-title").text("New User");
                        modal.find(".btn-edit").addClass("hidden");
                        modal.find(".btn-add").removeClass("hidden");
                    });
                  
                </script>