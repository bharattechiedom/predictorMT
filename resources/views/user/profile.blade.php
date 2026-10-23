<?php $page_title = "predictorMt - profile"; ?>



@include('user.include.header')





    <!-- Begin page -->

    <div class="wrapper active">

        <div class="page-content">

            <div class="myaccountPage p-4">



    <div class="row">

        <!-- LEFT PROFILE CARD -->
        <div class="col-lg-3 mb-4">

            <div class="card">

                <div class="card-body text-center">

                    <img src="https://img.magnific.com/free-photo/young-bearded-man-with-striped-shirt_273609-5677.jpg"
                        class="rounded-circle img-thumbnail mb-3 user-photo">

                    <h5 class="mb-1">Sujit Kumar</h5>

                    <p class="text-muted mb-3">
                        sujit@gmail.com
                    </p>

                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-camera"></i>
                        Change Photo
                    </button>

                </div>

            </div>

           

        </div>

        <!-- RIGHT CONTENT -->

        <div class="col-lg-9">

            <div class="card shadow-none border-1">

                <div class="card-header">

                    <ul class="nav nav-tabs setting-nav-tabs card-header-tabs" role="tablist">

                        <li class="nav-item">
                            <button class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#profile">
                                Profile
                            </button>
                        </li>

                        

                        <li class="nav-item">
                            <button class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#company">
                                Company Details
                            </button>
                        </li>

                        

                        <li class="nav-item">
                            <button class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#settings">
                                Settings
                            </button>
                        </li>

                        

                    </ul>

                </div>

                <div class="card-body bg-white">

                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="profile">
                            <h4>Update Your Profile</h4>
                            
                            <div class="dashboardForms">
    <div class="card shadow-none">
       
    <div class="card-body bg-white">




        @if ($errors->any())

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>

        @endif



        @if (session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>

        @endif



        <form method="POST" action="{{ route('user.profile.update') }}" id="profile-form">

            @csrf

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="first_name">Full Name</label>

                        <input 

                            type="text" 

                            name="first_name" 

                            id="first_name" 

                            placeholder="Enter First Name"

                            class="form-control @error('first_name') is-invalid @enderror" 

                            value="{{ explode(' ', $user->name)[0] ?? '' }}"

                            required>

                        @error('first_name')

                            <span class="invalid-feedback d-block">{{ $message }}</span>

                        @enderror

                    </div>

                </div>

                

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="email">Email</label>

                        <input 

                            type="email" 

                            name="email" 

                            id="email" 

                            placeholder="Enter your email"

                            class="form-control @error('email') is-invalid @enderror" 

                            value="{{ $user->email }}"

                            required>

                        @error('email')

                            <span class="invalid-feedback d-block">{{ $message }}</span>

                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="phone">Phone No</label>

                        <input 

                            type="tel" 

                            name="phone" 

                            id="phone" 

                            placeholder="Enter your Phone"

                            class="form-control @error('phone') is-invalid @enderror" 

                            value="{{ $user->phone }}"

                            required>

                        @error('phone')

                            <span class="invalid-feedback d-block">{{ $message }}</span>

                        @enderror

                    </div>

                </div>

            </div>



            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="country">Country</label>

                        <select id="country" name="country" class="form-control @error('country') is-invalid @enderror">

                            <option value="">Select Country</option>

                            <option value="Afghanistan" {{ $user->country === 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>

                            <option value="Albania" {{ $user->country === 'Albania' ? 'selected' : '' }}>Albania</option>

                            <option value="Algeria" {{ $user->country === 'Algeria' ? 'selected' : '' }}>Algeria</option>

                            <option value="Andorra" {{ $user->country === 'Andorra' ? 'selected' : '' }}>Andorra</option>

                            <option value="Angola" {{ $user->country === 'Angola' ? 'selected' : '' }}>Angola</option>

                            <option value="Antigua and Barbuda" {{ $user->country === 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>

                            <option value="Argentina" {{ $user->country === 'Argentina' ? 'selected' : '' }}>Argentina</option>

                            <option value="Armenia" {{ $user->country === 'Armenia' ? 'selected' : '' }}>Armenia</option>

                            <option value="Australia" {{ $user->country === 'Australia' ? 'selected' : '' }}>Australia</option>

                            <option value="Austria" {{ $user->country === 'Austria' ? 'selected' : '' }}>Austria</option>

                            <option value="Azerbaijan" {{ $user->country === 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>

                            <option value="Bahamas" {{ $user->country === 'Bahamas' ? 'selected' : '' }}>Bahamas</option>

                            <option value="Bahrain" {{ $user->country === 'Bahrain' ? 'selected' : '' }}>Bahrain</option>

                            <option value="Bangladesh" {{ $user->country === 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>

                            <option value="Barbados" {{ $user->country === 'Barbados' ? 'selected' : '' }}>Barbados</option>

                            <option value="Belarus" {{ $user->country === 'Belarus' ? 'selected' : '' }}>Belarus</option>

                            <option value="Belgium" {{ $user->country === 'Belgium' ? 'selected' : '' }}>Belgium</option>

                            <option value="Belize" {{ $user->country === 'Belize' ? 'selected' : '' }}>Belize</option>

                            <option value="Benin" {{ $user->country === 'Benin' ? 'selected' : '' }}>Benin</option>

                            <option value="Bhutan" {{ $user->country === 'Bhutan' ? 'selected' : '' }}>Bhutan</option>

                            <option value="Bolivia" {{ $user->country === 'Bolivia' ? 'selected' : '' }}>Bolivia</option>

                            <option value="Bosnia and Herzegovina" {{ $user->country === 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>

                            <option value="Botswana" {{ $user->country === 'Botswana' ? 'selected' : '' }}>Botswana</option>

                            <option value="Brazil" {{ $user->country === 'Brazil' ? 'selected' : '' }}>Brazil</option>

                            <option value="Brunei" {{ $user->country === 'Brunei' ? 'selected' : '' }}>Brunei</option>

                            <option value="Bulgaria" {{ $user->country === 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>

                            <option value="Burkina Faso" {{ $user->country === 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>

                            <option value="Burundi" {{ $user->country === 'Burundi' ? 'selected' : '' }}>Burundi</option>

                            <option value="Cambodia" {{ $user->country === 'Cambodia' ? 'selected' : '' }}>Cambodia</option>

                            <option value="Cameroon" {{ $user->country === 'Cameroon' ? 'selected' : '' }}>Cameroon</option>

                            <option value="Canada" {{ $user->country === 'Canada' ? 'selected' : '' }}>Canada</option>

                            <option value="Cape Verde" {{ $user->country === 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>

                            <option value="Central African Republic" {{ $user->country === 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>

                            <option value="Chad" {{ $user->country === 'Chad' ? 'selected' : '' }}>Chad</option>

                            <option value="Chile" {{ $user->country === 'Chile' ? 'selected' : '' }}>Chile</option>

                            <option value="China" {{ $user->country === 'China' ? 'selected' : '' }}>China</option>

                            <option value="Colombia" {{ $user->country === 'Colombia' ? 'selected' : '' }}>Colombia</option>

                            <option value="Comoros" {{ $user->country === 'Comoros' ? 'selected' : '' }}>Comoros</option>

                            <option value="Congo" {{ $user->country === 'Congo' ? 'selected' : '' }}>Congo</option>

                            <option value="Costa Rica" {{ $user->country === 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>

                            <option value="Croatia" {{ $user->country === 'Croatia' ? 'selected' : '' }}>Croatia</option>

                            <option value="Cuba" {{ $user->country === 'Cuba' ? 'selected' : '' }}>Cuba</option>

                            <option value="Cyprus" {{ $user->country === 'Cyprus' ? 'selected' : '' }}>Cyprus</option>

                            <option value="Czech Republic" {{ $user->country === 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>

                            <option value="Denmark" {{ $user->country === 'Denmark' ? 'selected' : '' }}>Denmark</option>

                            <option value="Djibouti" {{ $user->country === 'Djibouti' ? 'selected' : '' }}>Djibouti</option>

                            <option value="Dominica" {{ $user->country === 'Dominica' ? 'selected' : '' }}>Dominica</option>

                            <option value="Dominican Republic" {{ $user->country === 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>

                            <option value="Ecuador" {{ $user->country === 'Ecuador' ? 'selected' : '' }}>Ecuador</option>

                            <option value="Egypt" {{ $user->country === 'Egypt' ? 'selected' : '' }}>Egypt</option>

                            <option value="El Salvador" {{ $user->country === 'El Salvador' ? 'selected' : '' }}>El Salvador</option>

                            <option value="Equatorial Guinea" {{ $user->country === 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>

                            <option value="Eritrea" {{ $user->country === 'Eritrea' ? 'selected' : '' }}>Eritrea</option>

                            <option value="Estonia" {{ $user->country === 'Estonia' ? 'selected' : '' }}>Estonia</option>

                            <option value="Ethiopia" {{ $user->country === 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>

                            <option value="Fiji" {{ $user->country === 'Fiji' ? 'selected' : '' }}>Fiji</option>

                            <option value="Finland" {{ $user->country === 'Finland' ? 'selected' : '' }}>Finland</option>

                            <option value="France" {{ $user->country === 'France' ? 'selected' : '' }}>France</option>

                            <option value="Gabon" {{ $user->country === 'Gabon' ? 'selected' : '' }}>Gabon</option>

                            <option value="Gambia" {{ $user->country === 'Gambia' ? 'selected' : '' }}>Gambia</option>

                            <option value="Georgia" {{ $user->country === 'Georgia' ? 'selected' : '' }}>Georgia</option>

                            <option value="Germany" {{ $user->country === 'Germany' ? 'selected' : '' }}>Germany</option>

                            <option value="Ghana" {{ $user->country === 'Ghana' ? 'selected' : '' }}>Ghana</option>

                            <option value="Greece" {{ $user->country === 'Greece' ? 'selected' : '' }}>Greece</option>

                            <option value="Grenada" {{ $user->country === 'Grenada' ? 'selected' : '' }}>Grenada</option>

                            <option value="Guatemala" {{ $user->country === 'Guatemala' ? 'selected' : '' }}>Guatemala</option>

                            <option value="Guinea" {{ $user->country === 'Guinea' ? 'selected' : '' }}>Guinea</option>

                            <option value="Guinea-Bissau" {{ $user->country === 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>

                            <option value="Guyana" {{ $user->country === 'Guyana' ? 'selected' : '' }}>Guyana</option>

                            <option value="Haiti" {{ $user->country === 'Haiti' ? 'selected' : '' }}>Haiti</option>

                            <option value="Honduras" {{ $user->country === 'Honduras' ? 'selected' : '' }}>Honduras</option>

                            <option value="Hungary" {{ $user->country === 'Hungary' ? 'selected' : '' }}>Hungary</option>

                            <option value="Iceland" {{ $user->country === 'Iceland' ? 'selected' : '' }}>Iceland</option>

                            <option value="India" {{ $user->country === 'India' ? 'selected' : '' }}>India</option>

                            <option value="Indonesia" {{ $user->country === 'Indonesia' ? 'selected' : '' }}>Indonesia</option>

                            <option value="Iran" {{ $user->country === 'Iran' ? 'selected' : '' }}>Iran</option>

                            <option value="Iraq" {{ $user->country === 'Iraq' ? 'selected' : '' }}>Iraq</option>

                            <option value="Ireland" {{ $user->country === 'Ireland' ? 'selected' : '' }}>Ireland</option>

                            <option value="Israel" {{ $user->country === 'Israel' ? 'selected' : '' }}>Israel</option>

                            <option value="Italy" {{ $user->country === 'Italy' ? 'selected' : '' }}>Italy</option>

                            <option value="Jamaica" {{ $user->country === 'Jamaica' ? 'selected' : '' }}>Jamaica</option>

                            <option value="Japan" {{ $user->country === 'Japan' ? 'selected' : '' }}>Japan</option>

                            <option value="Jordan" {{ $user->country === 'Jordan' ? 'selected' : '' }}>Jordan</option>

                            <option value="Kazakhstan" {{ $user->country === 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>

                            <option value="Kenya" {{ $user->country === 'Kenya' ? 'selected' : '' }}>Kenya</option>

                            <option value="Kiribati" {{ $user->country === 'Kiribati' ? 'selected' : '' }}>Kiribati</option>

                            <option value="Kuwait" {{ $user->country === 'Kuwait' ? 'selected' : '' }}>Kuwait</option>

                            <option value="Kyrgyzstan" {{ $user->country === 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>

                            <option value="Laos" {{ $user->country === 'Laos' ? 'selected' : '' }}>Laos</option>

                            <option value="Latvia" {{ $user->country === 'Latvia' ? 'selected' : '' }}>Latvia</option>

                            <option value="Lebanon" {{ $user->country === 'Lebanon' ? 'selected' : '' }}>Lebanon</option>

                            <option value="Lesotho" {{ $user->country === 'Lesotho' ? 'selected' : '' }}>Lesotho</option>

                            <option value="Liberia" {{ $user->country === 'Liberia' ? 'selected' : '' }}>Liberia</option>

                            <option value="Libya" {{ $user->country === 'Libya' ? 'selected' : '' }}>Libya</option>

                            <option value="Liechtenstein" {{ $user->country === 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>

                            <option value="Lithuania" {{ $user->country === 'Lithuania' ? 'selected' : '' }}>Lithuania</option>

                            <option value="Luxembourg" {{ $user->country === 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>

                            <option value="Madagascar" {{ $user->country === 'Madagascar' ? 'selected' : '' }}>Madagascar</option>

                            <option value="Malawi" {{ $user->country === 'Malawi' ? 'selected' : '' }}>Malawi</option>

                            <option value="Malaysia" {{ $user->country === 'Malaysia' ? 'selected' : '' }}>Malaysia</option>

                            <option value="Maldives" {{ $user->country === 'Maldives' ? 'selected' : '' }}>Maldives</option>

                            <option value="Mali" {{ $user->country === 'Mali' ? 'selected' : '' }}>Mali</option>

                            <option value="Malta" {{ $user->country === 'Malta' ? 'selected' : '' }}>Malta</option>

                            <option value="Marshall Islands" {{ $user->country === 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>

                            <option value="Mauritania" {{ $user->country === 'Mauritania' ? 'selected' : '' }}>Mauritania</option>

                            <option value="Mauritius" {{ $user->country === 'Mauritius' ? 'selected' : '' }}>Mauritius</option>

                            <option value="Mexico" {{ $user->country === 'Mexico' ? 'selected' : '' }}>Mexico</option>

                            <option value="Micronesia" {{ $user->country === 'Micronesia' ? 'selected' : '' }}>Micronesia</option>

                            <option value="Moldova" {{ $user->country === 'Moldova' ? 'selected' : '' }}>Moldova</option>

                            <option value="Monaco" {{ $user->country === 'Monaco' ? 'selected' : '' }}>Monaco</option>

                            <option value="Mongolia" {{ $user->country === 'Mongolia' ? 'selected' : '' }}>Mongolia</option>

                            <option value="Montenegro" {{ $user->country === 'Montenegro' ? 'selected' : '' }}>Montenegro</option>

                            <option value="Morocco" {{ $user->country === 'Morocco' ? 'selected' : '' }}>Morocco</option>

                            <option value="Mozambique" {{ $user->country === 'Mozambique' ? 'selected' : '' }}>Mozambique</option>

                            <option value="Myanmar" {{ $user->country === 'Myanmar' ? 'selected' : '' }}>Myanmar</option>

                            <option value="Namibia" {{ $user->country === 'Namibia' ? 'selected' : '' }}>Namibia</option>

                            <option value="Nauru" {{ $user->country === 'Nauru' ? 'selected' : '' }}>Nauru</option>

                            <option value="Nepal" {{ $user->country === 'Nepal' ? 'selected' : '' }}>Nepal</option>

                            <option value="Netherlands" {{ $user->country === 'Netherlands' ? 'selected' : '' }}>Netherlands</option>

                            <option value="New Zealand" {{ $user->country === 'New Zealand' ? 'selected' : '' }}>New Zealand</option>

                            <option value="Nicaragua" {{ $user->country === 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>

                            <option value="Niger" {{ $user->country === 'Niger' ? 'selected' : '' }}>Niger</option>

                            <option value="Nigeria" {{ $user->country === 'Nigeria' ? 'selected' : '' }}>Nigeria</option>

                            <option value="North Korea" {{ $user->country === 'North Korea' ? 'selected' : '' }}>North Korea</option>

                            <option value="North Macedonia" {{ $user->country === 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>

                            <option value="Norway" {{ $user->country === 'Norway' ? 'selected' : '' }}>Norway</option>

                            <option value="Oman" {{ $user->country === 'Oman' ? 'selected' : '' }}>Oman</option>

                            <option value="Pakistan" {{ $user->country === 'Pakistan' ? 'selected' : '' }}>Pakistan</option>

                            <option value="Palau" {{ $user->country === 'Palau' ? 'selected' : '' }}>Palau</option>

                            <option value="Palestine" {{ $user->country === 'Palestine' ? 'selected' : '' }}>Palestine</option>

                            <option value="Panama" {{ $user->country === 'Panama' ? 'selected' : '' }}>Panama</option>

                            <option value="Papua New Guinea" {{ $user->country === 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>

                            <option value="Paraguay" {{ $user->country === 'Paraguay' ? 'selected' : '' }}>Paraguay</option>

                            <option value="Peru" {{ $user->country === 'Peru' ? 'selected' : '' }}>Peru</option>

                            <option value="Philippines" {{ $user->country === 'Philippines' ? 'selected' : '' }}>Philippines</option>

                            <option value="Poland" {{ $user->country === 'Poland' ? 'selected' : '' }}>Poland</option>

                            <option value="Portugal" {{ $user->country === 'Portugal' ? 'selected' : '' }}>Portugal</option>

                            <option value="Qatar" {{ $user->country === 'Qatar' ? 'selected' : '' }}>Qatar</option>

                            <option value="Romania" {{ $user->country === 'Romania' ? 'selected' : '' }}>Romania</option>

                            <option value="Russia" {{ $user->country === 'Russia' ? 'selected' : '' }}>Russia</option>

                            <option value="Rwanda" {{ $user->country === 'Rwanda' ? 'selected' : '' }}>Rwanda</option>

                            <option value="Saint Kitts and Nevis" {{ $user->country === 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>

                            <option value="Saint Lucia" {{ $user->country === 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>

                            <option value="Saint Vincent and the Grenadines" {{ $user->country === 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>

                            <option value="Samoa" {{ $user->country === 'Samoa' ? 'selected' : '' }}>Samoa</option>

                            <option value="San Marino" {{ $user->country === 'San Marino' ? 'selected' : '' }}>San Marino</option>

                            <option value="Sao Tome and Principe" {{ $user->country === 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>

                            <option value="Saudi Arabia" {{ $user->country === 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>

                            <option value="Senegal" {{ $user->country === 'Senegal' ? 'selected' : '' }}>Senegal</option>

                            <option value="Serbia" {{ $user->country === 'Serbia' ? 'selected' : '' }}>Serbia</option>

                            <option value="Seychelles" {{ $user->country === 'Seychelles' ? 'selected' : '' }}>Seychelles</option>

                            <option value="Sierra Leone" {{ $user->country === 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>

                            <option value="Singapore" {{ $user->country === 'Singapore' ? 'selected' : '' }}>Singapore</option>

                            <option value="Slovakia" {{ $user->country === 'Slovakia' ? 'selected' : '' }}>Slovakia</option>

                            <option value="Slovenia" {{ $user->country === 'Slovenia' ? 'selected' : '' }}>Slovenia</option>

                            <option value="Solomon Islands" {{ $user->country === 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>

                            <option value="Somalia" {{ $user->country === 'Somalia' ? 'selected' : '' }}>Somalia</option>

                            <option value="South Africa" {{ $user->country === 'South Africa' ? 'selected' : '' }}>South Africa</option>

                            <option value="South Korea" {{ $user->country === 'South Korea' ? 'selected' : '' }}>South Korea</option>

                            <option value="South Sudan" {{ $user->country === 'South Sudan' ? 'selected' : '' }}>South Sudan</option>

                            <option value="Spain" {{ $user->country === 'Spain' ? 'selected' : '' }}>Spain</option>

                            <option value="Sri Lanka" {{ $user->country === 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>

                            <option value="Sudan" {{ $user->country === 'Sudan' ? 'selected' : '' }}>Sudan</option>

                            <option value="Suriname" {{ $user->country === 'Suriname' ? 'selected' : '' }}>Suriname</option>

                            <option value="Sweden" {{ $user->country === 'Sweden' ? 'selected' : '' }}>Sweden</option>

                            <option value="Switzerland" {{ $user->country === 'Switzerland' ? 'selected' : '' }}>Switzerland</option>

                            <option value="Syria" {{ $user->country === 'Syria' ? 'selected' : '' }}>Syria</option>

                            <option value="Taiwan" {{ $user->country === 'Taiwan' ? 'selected' : '' }}>Taiwan</option>

                            <option value="Tajikistan" {{ $user->country === 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>

                            <option value="Tanzania" {{ $user->country === 'Tanzania' ? 'selected' : '' }}>Tanzania</option>

                            <option value="Thailand" {{ $user->country === 'Thailand' ? 'selected' : '' }}>Thailand</option>

                            <option value="Timor-Leste" {{ $user->country === 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>

                            <option value="Togo" {{ $user->country === 'Togo' ? 'selected' : '' }}>Togo</option>

                            <option value="Tonga" {{ $user->country === 'Tonga' ? 'selected' : '' }}>Tonga</option>

                            <option value="Trinidad and Tobago" {{ $user->country === 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>

                            <option value="Tunisia" {{ $user->country === 'Tunisia' ? 'selected' : '' }}>Tunisia</option>

                            <option value="Turkey" {{ $user->country === 'Turkey' ? 'selected' : '' }}>Turkey</option>

                            <option value="Turkmenistan" {{ $user->country === 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>

                            <option value="Tuvalu" {{ $user->country === 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>

                            <option value="Uganda" {{ $user->country === 'Uganda' ? 'selected' : '' }}>Uganda</option>

                            <option value="Ukraine" {{ $user->country === 'Ukraine' ? 'selected' : '' }}>Ukraine</option>

                            <option value="United Arab Emirates" {{ $user->country === 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>

                            <option value="United Kingdom" {{ $user->country === 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>

                            <option value="United States" {{ $user->country === 'United States' ? 'selected' : '' }}>United States</option>

                            <option value="Uruguay" {{ $user->country === 'Uruguay' ? 'selected' : '' }}>Uruguay</option>

                            <option value="Uzbekistan" {{ $user->country === 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>

                            <option value="Vanuatu" {{ $user->country === 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>

                            <option value="Vatican City" {{ $user->country === 'Vatican City' ? 'selected' : '' }}>Vatican City</option>

                            <option value="Venezuela" {{ $user->country === 'Venezuela' ? 'selected' : '' }}>Venezuela</option>

                            <option value="Vietnam" {{ $user->country === 'Vietnam' ? 'selected' : '' }}>Vietnam</option>

                            <option value="Yemen" {{ $user->country === 'Yemen' ? 'selected' : '' }}>Yemen</option>

                            <option value="Zambia" {{ $user->country === 'Zambia' ? 'selected' : '' }}>Zambia</option>

                            <option value="Zimbabwe" {{ $user->country === 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>

                        </select>

                        @error('country')

                            <span class="invalid-feedback d-block">{{ $message }}</span>

                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="state">State/Province</label>

                        <!-- Select shown when we have a mapping for the selected country -->

                        <select id="stateSelect" class="form-control @error('state') is-invalid @enderror">

                            <option value="">Select State/Province</option>

                        </select>



                        <!-- Text input fallback shown when no mapping exists -->

                        <input type="text" id="stateText" class="form-control d-none" placeholder="Enter State/Province">



                        <!-- Hidden field that will be submitted as `state` (populated by JS) -->

                        <input type="hidden" name="state" id="stateHidden" value="{{ $user->state ?? '' }}">



                        @error('state')

                            <span class="invalid-feedback d-block">{{ $message }}</span>

                        @enderror

                    </div>

                </div>

            </div>



            <div class="row mt-3">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="password">Password (leave blank to keep current)</label>

                        <input 

                            type="password" 

                            name="password" 

                            id="password" 

                            placeholder="Enter new password"

                            class="form-control @error('password') is-invalid @enderror">

                        @error('password')

                            <span class="invalid-feedback d-block">{{ $message }}</span>

                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="password_confirmation">Confirm Password</label>

                        <input 

                            type="password" 

                            name="password_confirmation" 

                            id="password_confirmation" 

                            placeholder="Confirm password"

                            class="form-control @error('password_confirmation') is-invalid @enderror">

                        @error('password_confirmation')

                            <span class="invalid-feedback d-block">{{ $message }}</span>

                        @enderror

                    </div>

                </div>

            </div>



            <div class="row">

                <div class="col-md-4 mt-3">

                    <button type="submit" class="lab-btn">Update Profile</button>

                </div>

            </div>



        </form>

    </div>

</div>

        </div>
                        </div>

                       

                        <div class="tab-pane fade" id="company">
                            <h4>Company Details</h4>
                        </div>

                        <div class="tab-pane fade" id="password">
                            <h4>Change Password</h4>
                        </div>

                       

                        <div class="tab-pane fade" id="settings">
                            <h4>Settings</h4>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
</div>
</div>


             







@include('user.include.footer')



<script>

    const statesByCountry = {

        "United States": ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"],

        "India": ["Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jharkhand","Karnataka","Kerala","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab","Rajasthan","Sikkim","Tamil Nadu","Telangana","Tripura","Uttar Pradesh","Uttarakhand","West Bengal","Delhi","Puducherry"],

        "Australia": ["New South Wales","Queensland","South Australia","Tasmania","Victoria","Western Australia","Australian Capital Territory","Northern Territory"],

        "Canada": ["Alberta","British Columbia","Manitoba","New Brunswick","Newfoundland and Labrador","Nova Scotia","Ontario","Prince Edward Island","Quebec","Saskatchewan","Northwest Territories","Nunavut","Yukon"],

        "United Kingdom": ["England","Scotland","Wales","Northern Ireland"],

        "Germany": ["Baden-Württemberg","Bavaria","Berlin","Brandenburg","Bremen","Hamburg","Hesse","Lower Saxony","Mecklenburg-Vorpommern","North Rhine-Westphalia","Rhineland-Palatinate","Saarland","Saxony","Saxony-Anhalt","Schleswig-Holstein","Thuringia"],

        "France": ["Auvergne-Rhône-Alpes","Bourgogne-Franche-Comté","Brittany","Centre-Val de Loire","Corsica","Grand Est","Hauts-de-France","Île-de-France","Normandy","Nouvelle-Aquitaine","Occitanie","Pays de la Loire","Provence-Alpes-Côte d'Azur"],

        "Japan": ["Hokkaido","Aomori","Iwate","Miyagi","Akita","Yamagata","Fukushima","Ibaraki","Tochigi","Gunma","Saitama","Chiba","Tokyo","Kanagawa","Niigata","Toyama","Ishikawa","Fukui","Yamanashi","Nagano","Gifu","Shizuoka","Aichi","Mie","Shiga","Kyoto","Osaka","Hyogo","Nara","Wakayama","Tottori","Shimane","Okayama","Hiroshima","Yamaguchi","Tokushima","Kagawa","Ehime","Kochi","Fukuoka","Saga","Nagasaki","Kumamoto","Oita","Miyazaki","Kagoshima","Okinawa"],

        "China": ["Anhui","Beijing","Chongqing","Fujian","Gansu","Guangdong","Guangxi","Guizhou","Hainan","Hebei","Heilongjiang","Henan","Hubei","Hunan","Jiangsu","Jiangxi","Jilin","Liaoning","Inner Mongolia","Ningxia","Qinghai","Shaanxi","Shandong","Shanghai","Shanxi","Sichuan","Tianjin","Tibet","Xinjiang","Yunnan","Zhejiang"]

    };



    const countrySelect = document.getElementById('country');

    const stateSelect = document.getElementById('stateSelect');

    const stateText = document.getElementById('stateText');

    const stateHidden = document.getElementById('stateHidden');

    const profileForm = document.getElementById('profile-form');



    function showSelect() {

        stateSelect.classList.remove('d-none');

        stateSelect.previousElementSibling && stateSelect.previousElementSibling.classList && stateSelect.previousElementSibling.classList.remove('d-none');

        stateText.classList.add('d-none');

    }



    function showText() {

        stateText.classList.remove('d-none');

        stateSelect.classList.add('d-none');

    }



    function populateStatesForCountry(country, selectedState = '') {

        // clear existing options

        stateSelect.innerHTML = '<option value="">Select State/Province</option>';



        if (!country || !statesByCountry[country]) {

            // No mapping: show text input and keep user's existing state

            showText();

            if (selectedState) stateText.value = selectedState;

            return;

        }



        const states = statesByCountry[country];

        states.forEach(state => {

            const opt = document.createElement('option');

            opt.value = state;

            opt.textContent = state;

            if (selectedState && selectedState === state) opt.selected = true;

            stateSelect.appendChild(opt);

        });



        showSelect();

    }



    document.addEventListener('DOMContentLoaded', function() {

        const initialCountry = @json($user->country ?? '');

        const initialState = @json($user->state ?? '');



        if (initialCountry) {

            // ensure country select shows selected option (HTML may have already done this)

            const countryOption = Array.from(countrySelect.options).find(o => o.value === initialCountry);

            if (countryOption) countryOption.selected = true;

        }



        populateStatesForCountry(initialCountry, initialState);

    });



    if (countrySelect) {

        countrySelect.addEventListener('change', function(e) {

            populateStatesForCountry(e.target.value, '');

        });

    }



    // Before submit, copy visible state value into hidden `state` input

    if (profileForm) {

        profileForm.addEventListener('submit', function(e) {

            let value = '';

            if (!stateSelect.classList.contains('d-none')) {

                value = stateSelect.value || '';

            } else {

                value = stateText.value || '';

            }

            stateHidden.value = value;

        });

    }

</script>

