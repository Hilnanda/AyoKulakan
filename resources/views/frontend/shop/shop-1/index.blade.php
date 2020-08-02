@extends('layouts.scaffold-sidebar-right')

@section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
@endsection

@section('rules')
	<script type="text/javascript">
		formRules = {
			judul: ['empty'],
		};
	</script>
@endsection

@section('content')


            <div class="blog-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="page-content blog-page blog-sidebar right-sidebar blog-text-align">
                                <!-- blog post -->
                                <article class="text-center">
                                    <div class="blog-entry-header">
                                        <div class="post-category">
                                            <a href="#">Fashion</a>
                                            <a href="#">Template</a>
                                        </div>
                                        <h1><a href="single-blog.html">Blog image post</a></h1>
                                        <div class="post-meta">
                                            <a href="#" class="post-author"><i class="fa fa-user"></i>Posted by admin</a>
                                            <a href="#" class="post-date"><i class="fa fa-calendar"></i> March 10, 2018 </a>
                                        </div>
                                    </div>
                                    <div class="post-thumbnail">
                                        <a href="single-blog.html"><img src="images/blog/blog1.jpg" alt="bege blog images"></a>
                                    </div>
                                    <div class="postinfo-wrapper">
                                        <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor</p>
                                        <a class="readmore button" href="single-blog.html">Read more</a>
                                        <div class="social-sharing">
                                            <h3>Share this post</h3>
                                            <div class="social-sharie">
                                                <ul class="social-icons">
                                                    <li><a class="facebook social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a class="twitter social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a class="pinterest social-icon" href="#"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a class="gplus social-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a class="linkedin social-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <!-- blog post end -->
                                <!-- blog post -->
                                <article class="text-center">
                                    <div class="blog-entry-header">
                                        <div class="post-category">
                                            <a href="#">GALLERY</a>
                                            <a href="#">Template</a>
                                        </div>
                                        <h1><a href="single-blog.html">POST WITH GALLERY</a></h1>
                                        <div class="post-meta">
                                            <a href="#" class="post-author"><i class="fa fa-user"></i>Posted by admin</a>
                                            <a href="#" class="post-date"><i class="fa fa-calendar"></i> March 10, 2018 </a>
                                        </div>
                                    </div>
                                    <div class="gallery-post owl-carousel owl-loaded owl-drag">
                                        
                                        
                                        
                                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1241px, 0px, 0px); transition: all 0s ease 0s; width: 4344px;"><div class="owl-item cloned" style="width: 620.5px;"><img src="images/blog/blog3.jpg" alt="bege blog images"></div><div class="owl-item cloned" style="width: 620.5px;"><img src="images/blog/blog4.jpg" alt="bege blog images"></div><div class="owl-item active" style="width: 620.5px;"><img src="images/blog/blog2.jpg" alt="bege blog images"></div><div class="owl-item" style="width: 620.5px;"><img src="images/blog/blog3.jpg" alt="bege blog images"></div><div class="owl-item" style="width: 620.5px;"><img src="images/blog/blog4.jpg" alt="bege blog images"></div><div class="owl-item cloned" style="width: 620.5px;"><img src="images/blog/blog2.jpg" alt="bege blog images"></div><div class="owl-item cloned" style="width: 620.5px;"><img src="images/blog/blog3.jpg" alt="bege blog images"></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i class="fa fa-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="fa fa-chevron-right"></i></button></div><div class="owl-dots disabled"></div></div>
                                    <div class="postinfo-wrapper">
                                        <br>
                                        <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor</p>
                                        <a class="readmore button" href="single-blog.html">Read more</a>
                                        <div class="social-sharing">
                                            <h3>Share this post</h3>
                                            <div class="social-sharie">
                                                <ul class="social-icons">
                                                    <li><a class="facebook social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a class="twitter social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a class="pinterest social-icon" href="#"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a class="gplus social-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a class="linkedin social-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <!-- blog post end -->
                                <!-- blog post -->
                                <article class="text-center">
                                    <div class="blog-entry-header">
                                        <div class="post-category">
                                            <a href="#">VIDEOS</a>
                                        </div>
                                        <h1><a href="single-blog.html">POST WITH VIDEO</a></h1>
                                        <div class="post-meta">
                                            <a href="#" class="post-author"><i class="fa fa-user"></i>Posted by admin</a>
                                            <a href="#" class="post-date"><i class="fa fa-calendar"></i> March 10, 2018 </a>
                                        </div>
                                    </div>
                                    <div class="post-thumbnail">
                                        <div class="fluid-width-video-wrapper" style="padding-top: 50%;"><iframe src="https://www.youtube.com/embed/Q6dsRpVyyWs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="" name="fitvid0"></iframe></div>
                                    </div>
                                    <div class="postinfo-wrapper">
                                        <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor</p>
                                        <a class="readmore button" href="single-blog.html">Read more</a>
                                        <div class="social-sharing">
                                            <h3>Share this post</h3>
                                            <div class="social-sharie">
                                                <ul class="social-icons">
                                                    <li><a class="facebook social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a class="twitter social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a class="pinterest social-icon" href="#"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a class="gplus social-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a class="linkedin social-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <!-- blog post end -->
                                <!-- blog post -->
                                <article class="text-center">
                                    <div class="blog-entry-header">
                                        <div class="post-category">
                                            <a href="#">AUDIO</a>
                                            <a href="#">Template</a>
                                        </div>
                                        <h1><a href="single-blog.html">POST WITH AUDIO</a></h1>
                                        <div class="post-meta">
                                            <a href="#" class="post-author"><i class="fa fa-user"></i>Posted by admin</a>
                                            <a href="#" class="post-date"><i class="fa fa-calendar"></i> March 10, 2018 </a>
                                        </div>
                                    </div>
                                    <div class="post-thumbnail">
                                        <iframe width="100%" height="auto" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/68283293&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>
                                    </div>
                                    <div class="postinfo-wrapper">
                                        <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor</p>
                                        <a class="readmore button" href="single-blog.html">Read more</a>
                                        <div class="social-sharing">
                                            <h3>Share this post</h3>
                                            <div class="social-sharie">
                                                <ul class="social-icons">
                                                    <li><a class="facebook social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a class="twitter social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a class="pinterest social-icon" href="#"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a class="gplus social-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a class="linkedin social-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <!-- blog post end -->
                                <!-- blog post -->
                                <article class="text-center">
                                    <div class="blog-entry-header">
                                        <div class="post-category">
                                            <a href="#">Fashion</a>
                                            <a href="#">Template</a>
                                        </div>
                                        <h1><a href="single-blog.html">Blog image post</a></h1>
                                        <div class="post-meta">
                                            <a href="#" class="post-author"><i class="fa fa-user"></i>Posted by admin</a>
                                            <a href="#" class="post-date"><i class="fa fa-calendar"></i> March 10, 2018 </a>
                                        </div>
                                    </div>
                                    <div class="post-thumbnail">
                                        <a href="single-blog.html"><img src="images/blog/blog5.jpg" alt="bege blog images"></a>
                                    </div>
                                    <div class="postinfo-wrapper">
                                        <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent ornare tortor</p>
                                        <a class="readmore button" href="single-blog.html">Read more</a>
                                        <div class="social-sharing">
                                            <h3>Share this post</h3>
                                            <div class="social-sharie">
                                                <ul class="social-icons">
                                                    <li><a class="facebook social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a class="twitter social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a class="pinterest social-icon" href="#"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a class="gplus social-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a class="linkedin social-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <!-- blog post end -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="pagination">
                                        <span aria-current="page" class="page-numbers current">1</span>
                                        <a class="page-numbers" href="#">2</a>
                                        <a class="next page-numbers" href="#">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
@endsection