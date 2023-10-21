@extends('layouts.front-site.frontend')

@section('front-body')
    <div class="container">
        <ol class="breadcrumb">profile
            <li><a href="#">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Contact</li>
        </ol>
        <!--end breadcrumb-->
        <section class="page-title center">
            <h1>Your Profile</h1>
        </section>
        <!--end page-title-->
        <section>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                    <form class="form inputs-underline">
                        <section>
                            <div class="user-details box">
                                <div class="user-image">
                                    <div class="image">
                                        <div class="bg-transfer"><img src="assets/img/person-01.jpg" alt=""></div>
                                        <!--end bg-transfer-->
                                        <div class="single-file-input">
                                            <input type="file" id="user_image" name="user_image">
                                            <div>Upload a picture<i class="fa fa-upload"></i></div>
                                        </div>
                                    </div>
                                    <!--end image-->

                                </div>
                                <!--end user-image-->
                                <div class="description clearfix">
                                    <h3>Your current plan</h3>
                                    <h2>Gold Package</h2>
                                    <a href="#" class="btn btn-default btn-rounded btn-xs">Change</a>
                                    <hr>
                                    <figure>
                                        <div class="pull-left"><strong>Next payment:</strong></div>
                                        <div class="pull-right">24/12/2015</div>
                                    </figure>
                                </div>
                                <!--end description-->
                            </div>
                        </section>
                        <!--end user-details-->
                        <section>
                            <h3>About You</h3>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                            value="Jane">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                            value="Green">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="jane@example.com">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            value="+1 260-478-7987">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                            </div>
                            <!--end row-->
                            <div class="form-group">
                                <label for="message">About You</label>
                                <textarea class="form-control" id="message" rows="2" name="message" placeholder="Something about me"></textarea>
                            </div>
                            <!--end form-group-->
                        </section>
                        <section>
                            <h3>Your Social Networks</h3>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook"
                                            placeholder="Facebook">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter"
                                            placeholder="Twitter">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="pinterest">Pinterest</label>
                                        <input type="text" class="form-control" name="pinterest" id="pinterest"
                                            placeholder="Pinterest">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="youtube">Youtube</label>
                                        <input type="text" class="form-control" name="youtube" id="youtube"
                                            placeholder="Youtube">
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end col-md-6-->
                            </div>
                            <!--end row-->
                        </section>
                        <section class="center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-rounded">Save Changes</button>
                            </div>
                            <!--end form-group-->
                        </section>
                    </form>
                    <!--end form-->
                    <hr>
                </div>
                <!--end col-md-6-->
            </div>
            <!--end row-->
        </section>
        <section>
            <section>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                        <h3 class="center">Change Your Password</h3>
                        <form class="form inputs-underline">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" name="current_password"
                                    id="current_password" value="******">
                            </div>
                            <!--end form-group-->
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                    placeholder="New Password">
                            </div>
                            <!--end form-group-->
                            <div class="form-group">
                                <label for="confirm_new_password">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_new_password"
                                    id="confirm_new_password" placeholder="Confirm New Password">
                            </div>
                            <!--end form-group-->
                            <div class="form-group center">
                                <button type="submit"
                                    class="btn btn-primary btn-framed btn-rounded btn-light-frame">Change Password</button>
                            </div>
                            <!--end form-group-->
                        </form>
                    </div>
                </div>
            </section>
        </section>
    </div>
    <!--end container-->
@endsection
