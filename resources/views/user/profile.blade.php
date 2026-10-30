@php
    $page_title = 'Profile & Settings';

    $countries = explode('|', 'Afghanistan|Albania|Algeria|Andorra|Angola|Antigua and Barbuda|Argentina|Armenia|Australia|Austria|Azerbaijan|Bahamas|Bahrain|Bangladesh|Barbados|Belarus|Belgium|Belize|Benin|Bhutan|Bolivia|Bosnia and Herzegovina|Botswana|Brazil|Brunei|Bulgaria|Burkina Faso|Burundi|Cambodia|Cameroon|Canada|Cape Verde|Central African Republic|Chad|Chile|China|Colombia|Comoros|Congo|Costa Rica|Croatia|Cuba|Cyprus|Czech Republic|Denmark|Djibouti|Dominica|Dominican Republic|Ecuador|Egypt|El Salvador|Equatorial Guinea|Eritrea|Estonia|Ethiopia|Fiji|Finland|France|Gabon|Gambia|Georgia|Germany|Ghana|Greece|Grenada|Guatemala|Guinea|Guinea-Bissau|Guyana|Haiti|Honduras|Hungary|Iceland|India|Indonesia|Iran|Iraq|Ireland|Israel|Italy|Jamaica|Japan|Jordan|Kazakhstan|Kenya|Kiribati|Kuwait|Kyrgyzstan|Laos|Latvia|Lebanon|Lesotho|Liberia|Libya|Liechtenstein|Lithuania|Luxembourg|Madagascar|Malawi|Malaysia|Maldives|Mali|Malta|Marshall Islands|Mauritania|Mauritius|Mexico|Micronesia|Moldova|Monaco|Mongolia|Montenegro|Morocco|Mozambique|Myanmar|Namibia|Nauru|Nepal|Netherlands|New Zealand|Nicaragua|Niger|Nigeria|North Korea|North Macedonia|Norway|Oman|Pakistan|Palau|Palestine|Panama|Papua New Guinea|Paraguay|Peru|Philippines|Poland|Portugal|Qatar|Romania|Russia|Rwanda|Saint Kitts and Nevis|Saint Lucia|Saint Vincent and the Grenadines|Samoa|San Marino|Sao Tome and Principe|Saudi Arabia|Senegal|Serbia|Seychelles|Sierra Leone|Singapore|Slovakia|Slovenia|Solomon Islands|Somalia|South Africa|South Korea|South Sudan|Spain|Sri Lanka|Sudan|Suriname|Sweden|Switzerland|Syria|Taiwan|Tajikistan|Tanzania|Thailand|Timor-Leste|Togo|Tonga|Trinidad and Tobago|Tunisia|Turkey|Turkmenistan|Tuvalu|Uganda|Ukraine|United Arab Emirates|United Kingdom|United States|Uruguay|Uzbekistan|Vanuatu|Vatican City|Venezuela|Vietnam|Yemen|Zambia|Zimbabwe');
@endphp

@include('user.include.header')

<main class="main-wrapper">
    <div class="container-fluid">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-md-2">
                @include('user.include.sidebar-nav')
            </div>

            {{-- Main Content --}}
            <div class="col-md-10">
                <div class="page-content m-auto p-3 mt-5">

                    {{-- Page Header --}}
                    <div class="mb-4">
                        <h3 class="fw-bold mb-1">Profile & Settings</h3>
                        <p class="text-muted mb-0">
                            Manage your personal information and account preferences.
                        </p>
                    </div>

                    {{-- Alerts --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-semibold mb-2">
                                <i class="fa-solid fa-circle-exclamation me-2"></i>
                                Please correct the following errors:
                            </div>

                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row g-4">

                        {{-- Profile Card --}}
                        <div class="col-lg-3">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-body text-center p-4">

                                    <div class="mb-3">
                                        <img
                                            src="https://img.magnific.com/free-photo/young-bearded-man-with-striped-shirt_273609-5677.jpg"
                                            alt="Profile photo"
                                            class="rounded-circle img-thumbnail profile-img-thumbnail object-fit-cover">
                                    </div>

                                    <h5 class="fw-bold mb-1 text-dark">
                                        {{ $user->name ?? 'User' }}
                                    </h5>

                                    <p class="text-muted small mb-3 text-break">
                                        {{ $user->email ?? '' }}
                                    </p>

                                    {{-- Photo upload is not connected to a backend route yet --}}
                                    <button type="button"
                                            class="btn btn-outline-primary btn-sm"
                                            disabled
                                            title="Photo upload is not configured">
                                        <i class="fa-solid fa-camera me-1"></i>
                                        Change Photo
                                    </button>

                                    <hr class="my-4">

                                    <div class="text-start">
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <i class="fa-regular fa-envelope text-muted"></i>
                                            <div class="min-w-0">
                                                <small class="text-muted d-block">Email Address</small>
                                                <span class="small text-break text-dark">
                                                    {{ $user->email ?? 'Not provided' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-phone text-muted"></i>
                                            <div>
                                                <small class="text-muted d-block">Phone Number</small>
                                                <span class="small text-dark">
                                                    {{ $user->phone ?: 'Not provided' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Profile Settings --}}
                        <div class="col-lg-9">
                            <div class="card border-0 shadow-none">

                                <div class="card-header bg-white p-0 pt-2">
                                    <ul class="nav nav-tabs card-header-tabs flex-nowrap overflow-auto"
                                        id="profileTabs"
                                        role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active"
                                                    id="profile-tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#profile-pane"
                                                    type="button"
                                                    role="tab"
                                                    aria-controls="profile-pane"
                                                    aria-selected="true">
                                                <i class="fa-regular fa-user me-1"></i>
                                                Profile
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link"
                                                    id="company-tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#company-pane"
                                                    type="button"
                                                    role="tab"
                                                    aria-controls="company-pane"
                                                    aria-selected="false">
                                                <i class="fa-solid fa-building me-1"></i>
                                                Company Details
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link"
                                                    id="settings-tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#settings-pane"
                                                    type="button"
                                                    role="tab"
                                                    aria-controls="settings-pane"
                                                    aria-selected="false">
                                                <i class="fa-solid fa-sliders me-1"></i>
                                                Settings
                                            </button>
                                        </li>

                                    </ul>
                                </div>

                                <div class="card-body p-3 p-md-4">

                                    <div class="tab-content">

                                        {{-- Profile Tab --}}
                                        <div class="tab-pane fade show active"
                                             id="profile-pane"
                                             role="tabpanel"
                                             aria-labelledby="profile-tab"
                                             tabindex="0">

                                            <div class="mb-4">
                                                <h5 class="fw-bold mb-1">Personal Information</h5>
                                                <p class="text-muted small mb-0">
                                                    Update your account details below.
                                                </p>
                                            </div>

                                            <form method="POST"
                                                  action="{{ route('user.profile.update') }}"
                                                  id="profile-form">
                                                @csrf

                                                <div class="row g-3">

                                                    {{-- Full Name --}}
                                                    <div class="col-md-6">
                                                        <label for="first_name" class="form-label fw-semibold">
                                                            Full Name <span class="text-danger">*</span>
                                                        </label>

                                                        <input
                                                            type="text"
                                                            name="first_name"
                                                            id="first_name"
                                                            class="form-control @error('first_name') is-invalid @enderror"
                                                            placeholder="Enter your name"
                                                            value="{{ old('first_name', $user->name) }}"
                                                            required>

                                                        @error('first_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- Email --}}
                                                    <div class="col-md-6">
                                                        <label for="email" class="form-label fw-semibold">
                                                            Email Address <span class="text-danger">*</span>
                                                        </label>

                                                        <input
                                                            type="email"
                                                            name="email"
                                                            id="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            placeholder="Enter your email"
                                                            value="{{ old('email', $user->email) }}"
                                                            required>

                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- Phone --}}
                                                    <div class="col-md-6">
                                                        <label for="phone" class="form-label fw-semibold">
                                                            Phone Number <span class="text-danger">*</span>
                                                        </label>

                                                        <input
                                                            type="tel"
                                                            name="phone"
                                                            id="phone"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            placeholder="Enter your phone number"
                                                            value="{{ old('phone', $user->phone) }}"
                                                            required>

                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- Country --}}
                                                    <div class="col-md-6">
                                                        <label for="country" class="form-label fw-semibold">
                                                            Country
                                                        </label>

                                                        <select
                                                            id="country"
                                                            name="country"
                                                            class="form-select @error('country') is-invalid @enderror">

                                                            <option value="">Select Country</option>

                                                            @foreach ($countries as $country)
                                                                <option
                                                                    value="{{ $country }}"
                                                                    @selected(old('country', $user->country) === $country)>
                                                                    {{ $country }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('country')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- State --}}
                                                    <div class="col-md-6">
                                                        <label for="stateSelect" class="form-label fw-semibold">
                                                            State / Province
                                                        </label>

                                                        <select
                                                            id="stateSelect"
                                                            class="form-select @error('state') is-invalid @enderror">
                                                            <option value="">Select State / Province</option>
                                                        </select>

                                                        <input
                                                            type="text"
                                                            id="stateText"
                                                            class="form-control d-none @error('state') is-invalid @enderror"
                                                            placeholder="Enter state or province">

                                                        <input
                                                            type="hidden"
                                                            name="state"
                                                            id="stateHidden"
                                                            value="{{ old('state', $user->state ?? '') }}">

                                                        @error('state')
                                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <hr class="my-4">

                                                <div class="mb-3">
                                                    <h6 class="fw-bold mb-1">Change Password</h6>
                                                    <p class="text-muted small mb-0">
                                                        Leave both password fields blank to keep your current password.
                                                    </p>
                                                </div>

                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label for="password" class="form-label fw-semibold">
                                                            New Password
                                                        </label>

                                                        <input
                                                            type="password"
                                                            name="password"
                                                            id="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="Enter new password"
                                                            autocomplete="new-password">

                                                        @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="password_confirmation" class="form-label fw-semibold">
                                                            Confirm Password
                                                        </label>

                                                        <input
                                                            type="password"
                                                            name="password_confirmation"
                                                            id="password_confirmation"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                                            placeholder="Confirm new password"
                                                            autocomplete="new-password">

                                                        @error('password_confirmation')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="d-flex flex-wrap gap-2 mt-4">
                                                    <button type="submit" class="btn theme-btn">
                                                        <i class="fa-solid fa-floppy-disk me-1"></i>
                                                        Update Profile
                                                    </button>

                                                    <button type="reset" class="btn btn-light border">
                                                        <i class="fa-solid fa-rotate-left me-1"></i>
                                                        Reset Form
                                                    </button>
                                                </div>

                                            </form>
                                        </div>

                                        {{-- Company Tab --}}
                                        <div class="tab-pane fade"
                                             id="company-pane"
                                             role="tabpanel"
                                             aria-labelledby="company-tab"
                                             tabindex="0">

                                            <div class="text-center py-5">
                                                <i class="fa-solid fa-building fs-1 text-muted mb-3"></i>
                                                <h5 class="fw-bold">Company Details</h5>
                                                <p class="text-muted mb-0">
                                                    Company information management is not connected to this page yet.
                                                </p>
                                            </div>

                                        </div>

                                        {{-- Settings Tab --}}
                                        <div class="tab-pane fade"
                                             id="settings-pane"
                                             role="tabpanel"
                                             aria-labelledby="settings-tab"
                                             tabindex="0">

                                            <div class="text-center py-5">
                                                <i class="fa-solid fa-sliders fs-1 text-muted mb-3"></i>
                                                <h5 class="fw-bold">Account Settings</h5>
                                                <p class="text-muted mb-0">
                                                    Additional account preferences can be configured here when their
                                                    backend functionality is available.
                                                </p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

@include('user.include.footer')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const statesByCountry = {
        "United States": [
            "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado",
            "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho",
            "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana",
            "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota",
            "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada",
            "New Hampshire", "New Jersey", "New Mexico", "New York",
            "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon",
            "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota",
            "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington",
            "West Virginia", "Wisconsin", "Wyoming"
        ],

        "India": [
            "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar",
            "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh",
            "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra",
            "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab",
            "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura",
            "Uttar Pradesh", "Uttarakhand", "West Bengal", "Delhi", "Puducherry"
        ],

        "Australia": [
            "New South Wales", "Queensland", "South Australia", "Tasmania",
            "Victoria", "Western Australia", "Australian Capital Territory",
            "Northern Territory"
        ],

        "Canada": [
            "Alberta", "British Columbia", "Manitoba", "New Brunswick",
            "Newfoundland and Labrador", "Nova Scotia", "Ontario",
            "Prince Edward Island", "Quebec", "Saskatchewan",
            "Northwest Territories", "Nunavut", "Yukon"
        ],

        "United Kingdom": [
            "England", "Scotland", "Wales", "Northern Ireland"
        ],

        "Germany": [
            "Baden-Württemberg", "Bavaria", "Berlin", "Brandenburg", "Bremen",
            "Hamburg", "Hesse", "Lower Saxony", "Mecklenburg-Vorpommern",
            "North Rhine-Westphalia", "Rhineland-Palatinate", "Saarland",
            "Saxony", "Saxony-Anhalt", "Schleswig-Holstein", "Thuringia"
        ],

        "France": [
            "Auvergne-Rhône-Alpes", "Bourgogne-Franche-Comté", "Brittany",
            "Centre-Val de Loire", "Corsica", "Grand Est", "Hauts-de-France",
            "Île-de-France", "Normandy", "Nouvelle-Aquitaine", "Occitanie",
            "Pays de la Loire", "Provence-Alpes-Côte d'Azur"
        ],

        "Japan": [
            "Hokkaido", "Aomori", "Iwate", "Miyagi", "Akita", "Yamagata",
            "Fukushima", "Ibaraki", "Tochigi", "Gunma", "Saitama", "Chiba",
            "Tokyo", "Kanagawa", "Niigata", "Toyama", "Ishikawa", "Fukui",
            "Yamanashi", "Nagano", "Gifu", "Shizuoka", "Aichi", "Mie", "Shiga",
            "Kyoto", "Osaka", "Hyogo", "Nara", "Wakayama", "Tottori", "Shimane",
            "Okayama", "Hiroshima", "Yamaguchi", "Tokushima", "Kagawa", "Ehime",
            "Kochi", "Fukuoka", "Saga", "Nagasaki", "Kumamoto", "Oita",
            "Miyazaki", "Kagoshima", "Okinawa"
        ],

        "China": [
            "Anhui", "Beijing", "Chongqing", "Fujian", "Gansu", "Guangdong",
            "Guangxi", "Guizhou", "Hainan", "Hebei", "Heilongjiang", "Henan",
            "Hubei", "Hunan", "Jiangsu", "Jiangxi", "Jilin", "Liaoning",
            "Inner Mongolia", "Ningxia", "Qinghai", "Shaanxi", "Shandong",
            "Shanghai", "Shanxi", "Sichuan", "Tianjin", "Tibet", "Xinjiang",
            "Yunnan", "Zhejiang"
        ]
    };

    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('stateSelect');
    const stateText = document.getElementById('stateText');
    const stateHidden = document.getElementById('stateHidden');
    const profileForm = document.getElementById('profile-form');

    if (!countrySelect || !stateSelect || !stateText || !stateHidden || !profileForm) {
        return;
    }

    function populateStates(country, selectedState = '') {
        stateSelect.innerHTML = '';

        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = 'Select State / Province';
        stateSelect.appendChild(placeholder);

        const states = statesByCountry[country];

        if (!states) {
            stateSelect.classList.add('d-none');
            stateText.classList.remove('d-none');
            stateText.value = selectedState;
            stateHidden.value = selectedState;
            return;
        }

        states.forEach(function (state) {
            const option = document.createElement('option');
            option.value = state;
            option.textContent = state;
            stateSelect.appendChild(option);
        });

        // Preserve an existing state even if it is not in the mapping.
        if (selectedState && !states.includes(selectedState)) {
            stateSelect.classList.add('d-none');
            stateText.classList.remove('d-none');
            stateText.value = selectedState;
            stateHidden.value = selectedState;
            return;
        }

        stateSelect.value = selectedState;
        stateSelect.classList.remove('d-none');
        stateText.classList.add('d-none');
        stateText.value = '';
        stateHidden.value = selectedState;
    }

    countrySelect.addEventListener('change', function () {
        populateStates(countrySelect.value, '');
    });

    stateSelect.addEventListener('change', function () {
        stateHidden.value = stateSelect.value;
    });

    stateText.addEventListener('input', function () {
        stateHidden.value = stateText.value;
    });

    profileForm.addEventListener('submit', function () {
        stateHidden.value = stateSelect.classList.contains('d-none')
            ? stateText.value
            : stateSelect.value;
    });

    const initialCountry = @json(old('country', $user->country ?? ''));
    const initialState = @json(old('state', $user->state ?? ''));

    populateStates(initialCountry, initialState);
});
</script>
