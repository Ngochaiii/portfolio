@extends('layouts.web.index')

@section('content')
    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Services
                </h2>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s1.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                SSL Certificates
                            </h4>
                            <p>
                                SSL certificates are digital credentials that authenticate website identity and enable
                                encrypted
                                connections between web servers and browsers
                            </p>
                            <a href="">
                                Read More
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                Dedicated Hosting
                            </h4>
                            <p>
                                Dedicated hosting provides an entire physical server exclusively for one client. This
                                hosting type
                                offers maximum performance, security
                            </p>
                            <a href="">
                                Read More
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s3.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                Cloud Hosting
                            </h4>
                            <p>
                                Cloud hosting utilizes a network of virtual servers drawing resources from an underlying
                                network of
                                physical servers. This model offers scalable resources
                            </p>
                            <a href="">
                                Read More
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s4.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                VPS Hosting
                            </h4>
                            <p>
                                VPS (Virtual Private Server) hosting provides a virtualized server environment that
                                simulates a
                                dedicated server within a shared hosting setup. Each VPS has dedicated resources including
                                CPU, RAM, and
                                storage,
                            </p>
                            <a href="">
                                Read More
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s5.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                Wordpress Hosting
                            </h4>
                            <p>
                                WordPress hosting is specifically optimized for WordPress websites, offering pre-configured
                                servers with
                                the ideal environment for the WordPress CMS. This specialized hosting includes automatic
                                WordPress
                                updates
                            </p>
                            <a href="">
                                Read More
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s6.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                Domain Name
                            </h4>
                            <p>
                                A domain name is the unique web address that identifies a website on the internet, such as
                                example.com.
                                It serves as a human-readable alternative to numerical IP addresses,making websites easy to
                                find and
                                remember
                            </p>
                            <a href="">
                                Read More
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end service section -->

    <!-- about section -->

    <section class="about_section layout_padding-bottom">
        <div class="container  ">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                About Our Hosting Company
                            </h2>
                        </div>
                        <p>
                            Founded with a passion for web technology and customer service, our hosting company has grown to
                            become a
                            trusted provider of digital infrastructure solutions. We pride ourselves on delivering reliable,
                            high-performance hosting services that empower businesses of all sizes to establish and expand
                            their
                            online presence.<br>
                            Our team consists of experienced IT professionals dedicated to ensuring your websites and
                            applications run
                            smoothly 24/7. We've invested in state-of-the-art data centers, cutting-edge technologies, and
                            robust
                            security systems to provide you with hosting solutions that meet the highest industry standards.
                            What sets us apart is our commitment to personalized support. We understand that every client
                            has unique
                            needs, which is why we offer customized hosting packages ranging from shared hosting for
                            startups to
                            dedicated servers for enterprise-level operations.<br>
                            As we continue to evolve with the digital landscape, we remain focused on our core mission:
                            providing you
                            with the technological foundation you need to succeed online while delivering exceptional value
                            and
                            service. </p>
                        <a href="">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="images/about-img.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- end about section -->


    <!-- server section -->

    <section class="server_section">
        <div class="container ">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{asset('assets/web/hostit/images/server-img.jpg')}}" alt="">
                        <div class="play_btn">
                            <button>
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Website Services Overview
                            </h2>
                            <p>
                                Our website offers comprehensive hosting solutions to power your online presence. From
                                shared hosting
                                for small websites to powerful dedicated servers for business applications, we provide a
                                range of
                                options tailored to your needs. Our services include shared hosting, dedicated hosting,
                                cloud hosting,
                                VPS solutions, WordPress-optimized environments, and domain registration services. Each
                                package comes
                                with reliable support, security features, and the performance you need to succeed online.
                                Let us handle
                                the technical details while you focus on growing your business.
                            </p>
                        </div>
                        <a href="">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end server section -->

    <!-- price section -->

    <section class="price_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Hosting Solutions
                </h2>
            </div>
            <div class="price_container">
                <div class="box">
                    <div class="detail-box">
                        <h2>1.800.000 <span>Đ/year</span></h2>
                        <h6>
                            SSL Certificates
                        </h6>
                        <ul class="price_features">
                            <li>
                                Website Identity Verification
                            </li>
                            <li>
                                Encrypted Data Transmission
                            </li>
                            <li>
                                HTTPS Website Security
                            </li>
                            <li>
                                Improved Search Rankings
                            </li>
                            <li>
                                Builds Customer Trust
                            </li>
                            <li>
                                Easy Installation Support
                            </li>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <a href="ssl.html">
                            See Detail
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="detail-box">
                        <h2>2.250.000 <span>Đ/year</span></h2>
                        <h6>
                            Dedicated Hosting
                        </h6>
                        <ul class="price_features">
                            <li>
                                Exclusive Server Resources
                            </li>
                            <li>
                                High Performance
                            </li>
                            <li>
                                Full Root Access
                            </li>
                            <li>
                                Custom Server Configuration
                            </li>
                            <li>
                                Enhanced Security
                            </li>
                            <li>
                                Premium Technical Support
                            </li>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <a href="dh.html">
                            See Detail
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="detail-box">
                        <h2>129.000 <span>Đ/month</span></h2>
                        <h6>
                            Cloud Hosting
                        </h6>
                        <ul class="price_features">
                            <li>
                                Scalable Resources
                            </li>
                            <li>
                                Pay-as-you-go Model
                            </li>
                            <li>
                                High Reliability
                            </li>
                            <li>
                                Distributed Architecture
                            </li>
                            <li>
                                Auto Scaling Options
                            </li>
                            <li>
                                Developer-friendly Tools
                            </li>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <a href="">
                            See Detail
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="detail-box">
                        <h2>129.000 <span>Đ/month</span></h2>
                        <h6>
                            VPS Hosting
                        </h6>
                        <ul class="price_features">
                            <li>
                                Dedicated Virtual Resources
                            </li>
                            <li>
                                SSD Storage
                            </li>
                            <li>
                                Root Access
                            </li>
                            <li>
                                Choice of OS
                            </li>
                            <li>
                                Resource Isolation
                            </li>
                            <li>
                                Scalable Configuration
                            </li>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <a href="">
                            See Detail
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="detail-box">
                        <h2>669.000 <span>Đ/month</span></h2>
                        <h6>
                            WordPress Hosting
                        </h6>
                        <ul class="price_features">
                            <li>
                                Pre-installed WordPress
                            </li>
                            <li>
                                Auto WordPress Updates
                            </li>
                            <li>
                                WordPress Optimized Servers
                            </li>
                            <li>
                                Built-in Caching
                            </li>
                            <li>
                                WordPress Security Features
                            </li>
                            <li>
                                One-click Staging
                            </li>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <a href="">
                            See Detail
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="detail-box">
                        <h2>2.333.333 <span>Đ/year</span></h2>
                        <h6>
                            Domain Name
                        </h6>
                        <ul class="price_features">
                            <li>
                                Domain Registration
                            </li>
                            <li>
                                Domain Transfer
                            </li>
                            <li>
                                DNS Management
                            </li>
                            <li>
                                Domain Privacy Protection
                            </li>
                            <li>
                                Auto-renewal Option
                            </li>
                            <li>
                                Email Forwarding
                            </li>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <a href="domain.html">
                            See Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- price section -->

    <!-- client section -->
    <section class="client_section ">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Testimonial
                </h2>
                <p>
                    Even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to
                </p>
            </div>
        </div>
        <div class="container px-0">
            <div id="customCarousel2" class="carousel  slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <div class="box">
                                        <div class="img-box">
                                            <img src="{{asset('assets/web/hostit/images/client.jpg')}}" alt="">
                                        </div>
                                        <div class="detail-box">
                                            <div class="client_info">
                                                <div class="client_name">
                                                    <h5>
                                                        Morojink
                                                    </h5>
                                                    <h6>
                                                        Customer
                                                    </h6>
                                                </div>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </div>
                                            <p>
                                                I've been using this hosting service for my e-commerce business for over two
                                                years now, and I
                                                couldn't be happier with my decision. The performance is outstanding - my
                                                website loads quickly
                                                even during peak traffic times, which has significantly improved my
                                                conversion rates. Their
                                                technical support team deserves special praise for their prompt responses
                                                and expert solutions
                                                whenever I've needed assistance.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <div class="box">
                                        <div class="img-box">
                                            <img src="{{asset('assets/web/hostit/images/client.jpg')}}" alt="">
                                        </div>
                                        <div class="detail-box">
                                            <div class="client_info">
                                                <div class="client_name">
                                                    <h5>
                                                        Morojink
                                                    </h5>
                                                    <h6>
                                                        Customer
                                                    </h6>
                                                </div>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </div>
                                            <p>
                                                Their WordPress hosting is top-notch. I’ve been using it for over 6 months
                                                now and haven’t had
                                                any downtime. The dashboard is easy to navigate, and I love the automatic
                                                backups. Very
                                                satisfied!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <div class="box">
                                        <div class="img-box">
                                            <img src="{{asset('assets/web/hostit/images/client.jpg')}}" alt="">
                                        </div>
                                        <div class="detail-box">
                                            <div class="client_info">
                                                <div class="client_name">
                                                    <h5>
                                                        Morojink
                                                    </h5>
                                                    <h6>
                                                        Customer
                                                    </h6>
                                                </div>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </div>
                                            <p>
                                                “We use their VPS hosting for our internal CRM system—super stable and fast.
                                                The tech support
                                                responds quickly and speaks both English and Vietnamese. Highly recommended
                                                for developers or
                                                startups.”
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end client section -->

    <!-- contact section -->
    <section class="contact_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Get In Touch
                </h2>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">
                        <form action="">
                            <div>
                                <input type="text" placeholder="Your Name" />
                            </div>
                            <div>
                                <input type="email" placeholder="Your Email" />
                            </div>
                            <div>
                                <input type="text" placeholder="Your Phone" />
                            </div>
                            <div>
                                <input type="text" class="message-box" placeholder="Message" />
                            </div>
                            <div class="btn_box ">
                                <button>
                                    SEND
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- info section -->
@endsection
