

<!DOCTYPE html>
<html lang="">
<head>
<title>Foxclore</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('images/demo/firstpage1.jpg');"> 

  <header id="header" class="hoc clear"> 
    
    <div id="logo" class="one_quarter first">
      <h1><a href="index.html">VogueVerse</a></h1>
      <p>The fit feed</p>
    </div>
    <div class="three_quarter">
      <ul class="nospace clear">
        <li class="one_third first">
          <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Give us a call:</strong> +00 (123) 456 7890</span></div>
        </li>
        <li class="one_third">
          <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> vogueverse01@gmail.com</span></div>
        </li>
        
      </ul>
    </div>

  </header>
 
  <section id="navwrapper" class="hoc clear"> 

    <nav id="mainav">
      <ul class="clear">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a class="drop" href="index.php">Blogs</a>
          
        </li>
        <li><a class="drop" href="#">About Us</a>
            </li>
          
    </nav>
    
    <div id="searchform">
      <div>
        <form action="#" method="post">
          <fieldset>
            <legend>Quick Search:</legend>
            <input type="text" placeholder="Enter search term&hellip;">
            <button type="submit"><i class="fas fa-search"></i></button>
          </fieldset>
        </form>
      </div>
    </div>

  </section>

  <div id="pageintro" class="hoc clear"> 
   
    <article>
     
      <h3 class="heading">VogueVerse</h3>
      <p>The Fit Feed: Where fashion bloggers set trends, share style, and connect. Join us to showcase your unique looks and inspire a style-savvy community!</p>
      <footer><a class="btn" href="#">Start Now</a></footer>
    </article>
   
  </div>
  
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
   
    <section id="introblocks">
      <!-- <ul class="nospace group">
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Aliquam faucibus</h6>
              <p>Ipsum eu ipsum donec ac orci sed lectus elementum fringilla nullam dictum nisi nec mauris phasellus ut lacus.</p>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Volutpat sed quis</h6>
              <p>Vel nisi semper adipiscing maecenas sodales elit cras porttitor diam aliquam turpis quisque rhoncus tincidunt.</p>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Leo phasellus sit</h6>
              <p>Arcu ut auctor nunc ac mi vivamus aliquam maecenas in lorem vel tellus porttitor placerat quisque tellus nulla.</p>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Amet lorem odio</h6>
              <p>Facilisis et mattis id consectetuer vel nunc donec sagittis purus sit amet est pellentesque elit dolor mattis.</p>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Semper aliquam duis</h6>
              <p>Ac lobortis sed cursus at magna vivamus laoreet orci vel tortor in nisi in porttitor vulputate arcu integer.</p>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x220.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Tempus mauris morbi</h6>
              <p>Pretium curabitur lacinia aenean eu lectus maecenas at urna morbi porta est a mi duis felis nunc lobortis ut.</p>
            </figcaption>
          </figure>
        </li>
      </ul> -->
      <ul class="nospace group">
        <?php
        require_once 'settings/connection.php';
        
        // Fetch posts from database
        $query = "SELECT * FROM Posts ORDER BY created_at DESC LIMIT 6";
        $result = mysqli_query($con, $query);
        
        // Loop through posts
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <li class="one_third">
            <figure>
              <a class="imgover" href="view/new_blog.php?postid=<?php echo $row['post_id']; ?>">
                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" style="width: 348px; height: 220px; object-fit: cover;">
              </a>
              <figcaption style="height: 200px; overflow: hidden;">
                <h6 class="heading" style="margin: 10px 0; height: 40px; overflow: hidden;"><?php echo htmlspecialchars($row['title']); ?></h6>
                <p style="height: 80px; overflow: hidden; margin-bottom: 10px;"><?php echo htmlspecialchars(substr($row['content'], 0, 100)) . '...'; ?></p>
  
              </figcaption>
              <a href="view/blog.php?postid=<?php echo $row['post_id']; ?>" class="button-56" style="display: inline-block; margin-top: 5px;">Read More</a>
            </figure>
          </li>
        <?php
        }
        ?>
      </ul>
    </section>
  
    <div class="clear"></div>
  </main>
</div>


<div class="wrapper coloured">
  <section id="testimonials" class="hoc container clear"> 
    <div class="sectiontitle">
      <p class="nospace font-xs">Timeless Style Icons Who Changed Fashion</p>
      <h6 class="heading">Words of Wisdom from Fashion Legends</h6>
    </div>
    <article class="one_half first"><img src="images/_.jpeg" alt="" style="max-width: 200px; height: auto;">
      <blockquote>Don't be into trends. Don't make fashion own you, but you decide what you are, what you want to express by the way you dress and the way to live</blockquote>
      <h6 class="heading">Gianni Versace</h6>
      </article>
    <article class="one_half"><img src="images/Diana Vreeland @ DOOR SELECTION.jpeg" alt="" style="max-width: 200px; height: auto;">
      <blockquote>You gotta have style. It helps you get down the stairs. It helps you get up in the morning. It's a way of life. Without it, you're nobody. I'm not talking about lots of clothes.</blockquote>
      <h6 class="heading">Diana Vreeland</h6>
      </article>
    
  </section>
</div>

<div class="bgded overlay row4" style="background-image:url('images/pexels-kseniachernaya-3965548.jpg');">
  <footer id="footer" class="hoc clear"> 

    <div class="center btmspace-50">
      <h6 class="heading">VogueVerse</h6>
      <ul class="faico clear">
        <li><a class="faicon-dribble" href="#"><i class="fab fa-dribbble"></i></a></li>
        <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li>
      </ul>
      <p class="nospace">Empowering Style, Inspiring Confidence, One Thread at a Time.</p>
    </div>
 
    <hr class="btmspace-50">
 
    
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>