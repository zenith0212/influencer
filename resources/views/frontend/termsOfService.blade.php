@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
@section('content')
  <main>

        <!-- Terms of Service section start from here -->
        <section class="termsservice_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-4 termsservice_leftmain" id="nav" data-spy="affix"
                        data-offset-top="197">
                        <ul class="termsservice_leftwrapper list-group">
                            <li>
                                <a class="list-group-item active" data-id="section1" href="#section1">
                                    Us or We
                                </a>
                            </li>
                            <li>
                                <a class="list-group-item" data-id="section2" href="#section2">
                                    Conduct on Website
                                </a>
                            </li>
                            <li>
                                <a class="list-group-item" data-id="section3" href="#section3">
                                    Third Party Websites
                                </a>
                            </li>
                            <li>
                                <a class="list-group-item" data-id="section4" href="#section4">
                                    Intellectual Property
                                </a>
                            </li>
                            <li>
                                <a class="list-group-item" data-id="section5" href="#section5">
                                    Disclaimer of Warranties
                                </a>
                            </li>
                            <li>
                                <a class="list-group-item" data-id="section6" href="#section6">
                                    International Use
                                </a>
                            </li>
                            <li>
                                <a class="list-group-item" data-id="section7" href="#section7">
                                    Termination
                                </a>
                            </li>
                            <li>
                                <a class="list-group-item" data-id="section8" href="#section8">
                                    Governing Law
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8 termsservice_rightmain">
                        <div id="section1" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <h1 class="subbanner-title mb-2">
                                Terms of
                                <span>Service</span>
                            </h1>
                            <p class="small_paraphrase mb-4">Last updated: March 01, 2023</p>
                            <p>
                                Topbrandmate ("Us" or "We") provides the www.topbrandmate.com website and various
                                related services (collectively, the "Website") to you, the User, subject to your
                                compliance with all the terms, conditions, and notices contained or referenced
                                herein (the "Terms of Service"), as well as any other written agreement between us
                                and you.
                                <br>
                                <br>
                                In addition, when using particular services or materials on this Website, Users
                                shall be subject to any posted rules applicable to such services or materials that
                                may contain terms and conditions in addition to those in these Terms of Service. All
                                such guidelines or rules are hereby incorporated by reference into these Terms of
                                Service.
                                <br>
                                <br>
                                These Terms of Service are effective as of [DATE]. We expressly reserve the right to
                                change these Terms of Service from time to time without notice to you. You
                                acknowledge and agree that it is your responsibility to review this Website and
                                these Terms of Service from time to time and to familiarize yourself with any
                                modifications.
                                <br>
                                <br>
                                Your continued use of this Website after such modifications will constitute
                                acknowledgement of the modified Terms of Service and agreement to abide and be bound
                                by the modified Terms of Service.
                                <br>
                                <br>
                                We reserve the sole right to either modify or discontinue the Website, including any
                                of the Website’s features, at any time with or without notice to you. We will not be
                                liable to you or any third party should we exercise such right. Any new features
                                that augment or enhance the then-current services on this Website shall also be
                                subject to these Terms of Service. This Terms of Service was created by Terms
                                Service Template Generator.
                            </p>
                        </div>
                        <div id="section2" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <div class="heading_intro">
                                <h3 class="mb-3 pb-1">Conduct on Website</h3>
                                <p class="pb-1">
                                    Your use of the Website is subject to all applicable laws and regulations, and you
                                    are
                                    solely responsible for the substance of your communications through the Website. By
                                    posting information in or otherwise using any communications service, chat room,
                                    message
                                    board, newsgroup, software library, or other interactive service that may be
                                    available
                                    to you on or through this Website, you agree that you will not upload, share, post,
                                    or
                                    otherwise distribute or facilitate distribution of any content — including text,
                                    communications, software, images, sounds, data, or other information — that:
                                </p>
                                <ul>
                                    <li>
                                        <p class="pb-1">
                                            Is unlawful, threatening, abusive, harassing, defamatory, libelous,
                                            deceptive, fraudulent, invasive of another’s privacy, tortious, contains
                                            explicit or graphic descriptions or accounts of sexual acts (including but
                                            not limited to sexual language of a violent or threatening nature directed
                                            at another individual or group of individuals), or otherwise violates our
                                            rules or policies
                                        </p>
                                    </li>
                                    <li>
                                        <p class="pb-1">
                                            Victimizes, harasses, degrades, or intimidates an individual or group of
                                            individuals on the basis of religion, gender, sexual orientation, race,
                                            ethnicity, age, or disability
                                        </p>
                                    </li>
                                    <li>
                                        <p class="pb-1">
                                            Infringes on any patent, trademark, trade secret, copyright, right of
                                            publicity, or other proprietary right of any party
                                        </p>
                                    </li>
                                    <li>
                                        <p class="pb-1">
                                            Constitutes unauthorized or unsolicited advertising, junk or bulk email
                                            (also known as "spamming"), chain letters, any other form of unauthorized
                                            solicitation, or any form of lottery or gambling
                                        </p>
                                    </li>
                                    <li>
                                        <p class="pb-1">
                                            Contains software viruses or any other computer code, files, or programs
                                            that are designed or intended to disrupt, damage, or limit the functioning
                                            of any software, hardware, or telecommunications equipment or to damage or
                                            obtain unauthorized access to any data or other information of any third
                                            party
                                        </p>
                                    </li>
                                    <li>
                                        <p class="pb-3">
                                            Impersonates any person or entity, including any of our employees or
                                            representatives
                                        </p>
                                    </li>
                                </ul>
                                <p class="mb-0">
                                    We neither endorse nor assume any liability for the contents of any material
                                    uploaded or submitted by third party users of the Website. We generally do not
                                    pre-screen, monitor, or edit the content posted by users of communications services,
                                    chat rooms, message boards, newsgroups, software libraries, or other interactive
                                    services that may be available on or through this Website. However, we and our
                                    agents have the right at their sole discretion to remove any content that, in our
                                    judgment, does not comply with these Terms of Service and any other rules of user
                                    conduct for our site, or is otherwise harmful, objectionable, or inaccurate. We are
                                    not responsible for any failure or delay in removing such content. You hereby
                                    consent to such removal and waive any claim against us arising out of such removal
                                    of content.
                                    <br>
                                    <br>
                                    You agree that we may at any time, and at our sole discretion, terminate your
                                    membership, account, or other affiliation with our site without prior notice to you
                                    for violating any of the above provisions. In addition, you acknowledge that we will
                                    cooperate fully with investigations of violations of systems or network security at
                                    other sites, including cooperating with law enforcement authorities in investigating
                                    suspected criminal violations.
                                </p>
                            </div>
                        </div>
                        <div id="section3" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <div class="heading_intro">
                                <h3 class="mb-3 pb-1">Third Party Websites</h3>
                                <p class="mb-0">
                                    This site may link you to other sites on the Internet or otherwise include
                                    references to information, documents, software, materials and/or services provided
                                    by other parties. These sites may contain information or material that some people
                                    may find inappropriate or offensive.
                                    <br>
                                    <br>
                                    These other sites and parties are not under our control, and you acknowledge that we
                                    are not responsible for the accuracy, copyright compliance, legality, decency, or
                                    any other aspect of the content of such sites, nor are we responsible for errors or
                                    omissions in any references to other parties or their products and services. The
                                    inclusion of such a link or reference is provided merely as a convenience and does
                                    not imply endorsement of, or association with, the Website or party by us, or any
                                    warranty of any kind, either express or implied.
                                </p>
                            </div>
                        </div>
                        <div id="section4" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <div class="heading_intro">
                                <h3 class="mb-3 pb-1">Intellectual Property</h3>
                                <p class="mb-0">
                                    All custom graphics, icons, logos, and service names used on the Website are
                                    registered trademarks, service marks, and/or artwork held under copyright of
                                    Topbrandmate or its Affiliates. All other marks are property of their respective
                                    owners. Nothing in these Terms of Service grants you any right to use any trademark,
                                    service mark, logo, and/or the name or trade names of Topbrandmate or its
                                    Affiliates.
                                </p>
                            </div>
                        </div>
                        <div id="section5" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <div class="heading_intro">
                                <h3 class="mb-3 pb-1">Disclaimer of Warranties</h3>
                                <p class="mb-0">
                                    Content available through this Website often represents the opinions and judgments
                                    of an information provider, site user, or other person or entity not connected with
                                    us. We do not endorse, nor are we responsible for the accuracy or reliability of,
                                    any opinion, advice, or statement made by anyone other than an authorized
                                    Topbrandmate spokesperson speaking in his/her official capacity. Please refer to the
                                    specific editorial policies posted on various sections of this Website for further
                                    information, which policies are incorporated by reference into these Terms of
                                    Service.
                                    <br>
                                    <br>
                                    You understand and agree that temporary interruptions of the services available
                                    through this Website may occur as normal events. You further understand and agree
                                    that we have no control over third party networks you may access in the course of
                                    the use of this Website, and therefore, delays and disruption of other network
                                    transmissions are completely beyond our control.
                                    <br>
                                    <br>
                                    You understand and agree that the services available on this Website are provided
                                    "AS IS" and that we assume no responsibility for the timeliness, deletion,
                                    mis-delivery or failure to store any user communications or personalization
                                    settings.
                                </p>
                            </div>
                        </div>
                        <div id="section6" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <div class="heading_intro">
                                <h3 class="mb-3 pb-1">International Use</h3>
                                <p class="mb-0">
                                    Although this Website may be accessible worldwide, we make no representation that
                                    materials on this Website are appropriate or available for use in locations outside
                                    the United States, and accessing them from territories where their contents are
                                    illegal is prohibited. Those who choose to access this Website from other locations
                                    do so on their own initiative and are responsible for compliance with local laws.
                                    Any offer for any product, service, and/or information made in connection with this
                                    Website is void where prohibited.
                                </p>
                            </div>
                        </div>
                        <div id="section7" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <div class="heading_intro">
                                <h3 class="mb-3 pb-1">Termination</h3>
                                <p class="mb-0">
                                    You agree that we may, in our sole discretion, terminate or suspend your access to
                                    all or part of the Website with or without notice and for any reason, including,
                                    without limitation, breach of these Terms of Service. Any suspected fraudulent,
                                    abusive or illegal activity may be grounds for terminating your relationship and may
                                    be referred to appropriate law enforcement authorities.
                                    <br>
                                    <br>
                                    Upon termination or suspension, regardless of the reasons therefore, your right to
                                    use the services available on this Website immediately ceases, and you acknowledge
                                    and agree that we may immediately deactivate or delete your account and all related
                                    information and files in your account and/or bar any further access to such files or
                                    this Website. We shall not be liable to you or any third party for any claims or
                                    damages arising out of any termination or suspension or any other actions taken by
                                    us in connection with such termination or suspension.
                                </p>
                            </div>
                        </div>
                        <div id="section8" class="mb-5 pb-md-2 pb-lg-4 pb-xl-5">
                            <div class="heading_intro">
                                <h3 class="mb-3 pb-1">Governing Law</h3>
                                <p class="mb-0">
                                    These Terms of Service and any dispute or claim arising out of, or related to them,
                                    shall be governed by and construed in accordance with the internal laws of the us
                                    without giving effect to any choice or conflict of law provision or rule.
                                    <br>
                                    <br>
                                    Any legal suit, action or proceeding arising out of, or related to, these Terms of
                                    Service or the Website shall be instituted exclusively in the federal courts of us.
                                </p>
                            </div>
                        </div>

                        <div>
                            <a href="" class="primary-btn justify-content-center min-w-190 me-3 me-sm-4">
                                I Agree
                            </a>
                            <a href="" class="primaryline-btn justify-content-center min-w-190">
                                <span>Decline</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Terms of Service section end from here -->

    </main>

@endsection
