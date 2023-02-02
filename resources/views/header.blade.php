<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset("css/header.css")}}">
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
    <link rel="stylesheet" href="{{asset("css/card.css")}}">
    <link rel="stylesheet" href="{{asset("css/alert.css")}}">
    <link rel="stylesheet" href="{{asset("css/auth.css")}}">
    <link rel="stylesheet" href="{{asset("css/post.css")}}">
    <link rel="stylesheet" href="{{asset("css/create.css")}}">
    <link rel="stylesheet" href="{{asset("css/edit.css")}}">
    <link rel="stylesheet" href="{{asset("css/myposts.css")}}">
    <title>eBlog</title>

    <!-- fonts -->
    <link 
        rel="preconnect"
        href="https://fonts.googleapis.com"
    />
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com" crossorigin 
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <script defer src="{{asset("js/app.js")}}"></script>
  </head>
  <body>

    <!-- page header  -->
    <div class="header">
      <div class="nav-container">
        @guest
        <a href="/blog/">
          <span class="logo">
              e<span>B</span>log
          </span>
        </a>
        <span>
            <button id="create-post">Create Post</button>
            <a href="{{asset("signup")}}" class="signup">SignUp</a>
            <a href="{{asset("login")}}" class="login">Login</a>
        </span>
        @endguest

        @auth
          <div class="left-side">
            <a href="#">
              <span class="logo"> e<span>B</span>log </span>
            </a>
            <button id="create-post">Create Post</button>
            <a href="#"><button id="create-post">My posts</button></a>
          </div>
          <span>
              <span style="color: #fff; padding: 0 15px">Hello User</span>
              <a href="#" class="logout">Logout</a>
          </span>
        @endauth
      </div>  
    </div>  

    <!-- create post window  -->
    <div class="create-modal modal-container">
      <div class="create-modal modal-header">
        <button class="close-btn" id="create-close-btn">&times;</button>
      </div>
      <div class="create-modal modal-body">
        <form action="#" method="POST">
          <!-- title -->
          <label for="title">
            Title
            <span style="color: red">*</span>
          </label>
          <input
            class="equal-width"
            type="text"
            id="title"
            placeholder="type the post title.."
            name="title"
          />
          <!-- image -->
          <label for="image">
              Image
              <span style="color: red">*</span>
            </label>
            <input
              class="equal-width"
              type="text"
              id="image"
              placeholder="type the post img number.."
              name="image"
            />
          <!-- body  -->
          <label for="body">
            Body
            <span style="color: red">*</span>
          </label>
          <textarea
            class="equal-width"
            type="text"
            id="text-body"
            placeholder="type the post body.."
            name="body"
          ></textarea>
          <!-- buttons -->
          <input
            class="equal-width"
            type="submit"
            value="Create"
            id="submit-button"
            class="buttons"
            name="post-create-form"
          />
        </form>
      </div>
    </div>

    <!-- page alerts   -->
      <div class="alert-msg">
        <button class="close-btn">&times;</button>
        <p>An alert message!</p>
      </div>
