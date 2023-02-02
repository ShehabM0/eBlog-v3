    @extends('header')
      <div class="container">
        <div class="auth-img-container">
          <div class="img">
            <img src="{{asset("img/11.jpg")}}" alt="" />
          </div>
        </div>
        <div class="form-container">
          <form action="#" method="POST">
            <h2>Hi, Welcome Back!</h2>
            <input
              type="email"
              placeholder="Email"
              required="required"
              name="email"
            />
            <input
              type="password"
              placeholder="Password"
              required="required"
              name="password"
            />
            <div class="p-class">
              <input
                type="submit"
                id="submit-btn"
                value="Log In"
                name="loginform"
              />
              <p>Don't have an account?</p><a href="{{asset("signup")}}">SignUp</a>
            </div>
          </form>
        </div>
      </div>
    </body>
</html>
