@include('include.header')

<div class="clearfix"></div>

<div class="condition-div">
    <div class="custom-breadcrumb mt-0">
        <span class="home-icon">
            <i class="fa-solid fa-house"></i>
        </span>

        <a href="{{ route('home')}}">Home</a>
        <span class="arrow">›</span>

        <a href="#">Solution </a>
        <span class="arrow">›</span>
    </div>


    <section class="solution-section">
        <div class="container">

            <div class="solution-top">
                <div class="solution-image">
                    <img src="{{ asset('public/assets/images/solution.png') }}" alt="Predictive Maintenance">
                </div>

                <div class="solution-content">
                    <h5 class="section-tag">SOLUTIONS</h5>
                    <h2>An End-To-End IIoT Business Solution</h2>
                    <p>
                        PredictorMT is an innovative platform revolutionizing predictive maintenance
                        by integrating IoT sensors, historical data, and external factors to deliver
                        real-time asset health insights.
                    </p>
                </div>
            </div>

            <div class="solution-cards">
                <div class="solution-card">
                    <div class="solution-img"><img src="{{ asset('public/assets/images/predictive.png') }}" alt=""></div>
                    <h4>Predictive Maintenance Engine</h4>
                    <p>Identify equipment failures before they occur and reduce unplanned downtime.</p>
                </div>

                <div class="solution-card">
                    <div class="solution-img"><img src="{{ asset('public/assets/images/iot.png') }}" alt=""></div>
                    <h4>IoT Sensor Technology</h4>
                    <p>Real-time monitoring using intelligent sensors and cloud connectivity.</p>
                </div>

                <div class="solution-card">
                    <div class="solution-img"><img src="{{ asset('public/assets/images/historical.png') }}" alt=""></div>
                    <h4>Historical & External Data</h4>
                    <p>Combine IoT, historical and external data for accurate predictive insights.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-img"><img src="{{ asset('public/assets/images/end-to-end.png') }}" alt=""></div>
                    <h4>End-to-End Workflow
                    </h4>
                    <p>Real time updates on machine specific parameters. Easy access to machine performance and risk analytics
                        reports. Asset performance visualization and trends analysis. IoT sensors control and monitoring.</p>
                </div>

                   <div class="solution-card">
                <div class="solution-img"><img src="{{ asset('public/assets/images/dashboard_analytics.png') }}" alt=""></div>
                <h4>Dashboard & Analytics
                </h4>
                <p>PredictorMT Platform gives users complete visibility when it comes to tracking machine parameters including
                    energy consumption and operational conditions like weather or air quality, with analysis of historical
                    patterns and anomalies, facilitating timely maintenance.

                </p>

            </div>

             <div class="solution-card">
                <div class="solution-img"><img src="{{ asset('public/assets/images/parameter-tracking.png') }}" alt=""></div>
                <h4>Parameter Tracking
                </h4>
                <p>
                    • Sensors are attached to equipment <br>
                    • Sensors connect with maintenance systems <br>
                    • Equipment performance data is continuously collected <br>
                    • Trends are identified and parameters are defined <br>
                    • Equipment runs under normal conditions <br>
                    • Sensors detect performance deviations <br>
                    • Work orders are automatically generated <br>
                    • Maintenance actions are performed on time 
                </p>
            </div>
            </div>

         
           

        </div>
    </section>









    @include('include.footer')