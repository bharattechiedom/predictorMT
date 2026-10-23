@include('include.header')

<div class="condition-div">
    <div class="custom-breadcrumb mt-0">
        <span class="home-icon">
            <i class="fa-solid fa-house"></i>
        </span>

        <a href="{{ route('home')}}">Home</a>
        <span class="arrow">›</span>

        <a href="#">Industries </a>
        <span class="arrow">›</span>

    </div>


    <div class="container-fluid industry-container ">
         <h3 class="title text-center p-3">Industries</h3>
        <div class="text-center aos-init aos-animate" data-aos="fade-down">
            <img src="https://predictormt.ca/UAT/public/assets/images/9.png" alt="" class="mrt-31 arwimg">
        </div>
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-lg-4 col-md-4">
                    <div class="industry-card">
                        <div class="icon-div"> <i class="fa-solid fa-mountain"></i>
                        </div>
                        <div>
                            <h3 class="industry-heading">Mining <span>Exploration</span></h3>
                            <p>
                                Leading companies specializing in mining and exploration activities, totaling around 3,000.
                                These companies are involved in discovering and extracting valuable minerals and resources,
                                driving growth in the mining sector.
                            </p>
                        </div>

                    </div>
                    <div class="data-quantity">
                        <h4>Mining & Exploration Companies</h4>
                        <h6>3,000+</h6>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="industry-card">
                        <div class="icon-div"> <i class="fa-solid fa-truck"></i>
                        </div>
                        <div>
                            <h3 class="industry-heading">Trucking <span>Companies</span></h3>
                            <p>
                                A vast network of trucking companies, with over 134,000 registered businesses.
                                These companies ensure efficient transportation and logistics services across the country,
                                supporting various industries and supply chains.
                            </p>
                        </div>

                    </div>
                    <div class="data-quantity">
                        <h4>Trucking Companies</h4>
                        <h6>134,000+</h6>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="industry-card">
                        <div class="icon-div">
                            <i class="fa-solid fa-industry"></i>

                        </div>
                        <div>
                            <h3 class="industry-heading">Our <span>Manufacturers</span></h3>
                            <p>
                                Approximately 92,752 manufacturers operating in diverse industries nationwide.
                                These manufacturers produce a wide range of goods, contributing significantly
                                to the economy and employment.
                            </p>
                        </div>

                    </div>
                    <div class="data-quantity">
                        <h4>Manufacturers</h4>
                        <h6>92,752+</h6>
                    </div>
                </div>
            </div>

            <!-- Second row starts here -->
            <div class="row mt-5">

                <div class="col-lg-4 col-md-4">
                    <div class="industry-card">
                        <div class="icon-div"> <i class="fa-solid fa-tractor"></i>
                        </div>
                        <div>
                            <h3 class="industry-heading">Agriculture <span>Equipment</span></h3>
                            <p>
                                Manufacturers focused on agriculture equipment, numbering about 1,500 companies.
                                They develop innovative machinery and tools that help improve farming efficiency
                                and productivity nationwide.
                            </p>
                        </div>

                    </div>
                    <div class="data-quantity">
                        <h4>Agriculture Equipment Manufacturers</h4>
                        <h6>1,500+</h6>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="industry-card">
                        <div class="icon-div"> <i class="fa-solid fa-warehouse"></i>
                        </div>
                        <div>
                            <h3 class="industry-heading">Our <span>Warehousing</span></h3>
                            <p>
                                Establishments totaling 2,583 warehouses providing storage and logistics services.
                                These warehouses play a critical role in inventory management and supply chain optimization.
                            </p>
                        </div>

                    </div>
                    <div class="data-quantity">
                        <h4>Warehousing Establishments</h4>
                        <h6>2,583+</h6>
                    </div>
                </div>

            </div>


        </div>


    </div>
    @include('include.footer')