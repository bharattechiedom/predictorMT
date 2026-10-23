</div>

</div>

  

  <!-- Logout Form -->

  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">

        @csrf

    </form>


    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>

