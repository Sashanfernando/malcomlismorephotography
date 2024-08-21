<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Testimonials - Malcolm Lismore Photography</title>
    <link rel="stylesheet" href="css/manage-testimonials.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<header>
    <div class="logo">
        <img src="../logo1.jpeg" alt="Malcolm Lismore Photography">
    </div>
    <nav>
        <ul>
            <li><a href="html/index.html">Home</a></li>
            <li class="dropdown">
                <a href="html/services.html" class="dropbtn">Services</a>
                <div class="dropdown-content">
                    <a href="html/services.html">Weddings</a>
                    <a href="html/services.html">Portraits</a>
                    <a href="html/services.html">Special Events</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="html/gallery.html" class="dropbtn">Gallery</a>
                <div class="dropdown-content">
                    <a href="html/gallery.html">Landscape</a>
                    <a href="html/gallery.html">Wildlife</a>
                    <a href="html/gallery.html">Coastal Bird</a>
                </div>
            </li>
            <li><a href="html/login.html">Sign In</a></li>
        </ul>
    </nav>
</header>

<main class="admin-dashboard">
    <aside class="sidebar">
        <ul>
            <li><a href="html/admin-dashboard.html">Upload New Images</a></li>
            <li><a href="delete-image.php">Delete Images</a></li>
            <li><a href="manage-enquiries.php">Manage Enquiries</a></li>
            <li><a href="html/edit-profile.html">Edit Profile</a></li>
            <li><a href="manage-accounts.php">Manage Accounts</a></li>
            <li><a href="manage-testimonials.php">Manage Testimonials</a></li>
        </ul>
    </aside>

    <section class="content">
        <h2>Manage Testimonials</h2>
        <table class="testimonial-table">
            <thead>
            <tr>
                <th>Testimonial ID</th>
                <th>Customer Name</th>
                <th>Testimonial</th>
                <th>Profile Picture</th>
                <th>Controls</th>
            </tr>
            </thead>
            <tbody>
            <?php
           
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "photography_website";

            
            $conn = new mysqli($servername, $username, $password, $dbname);

          
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

           
            $sql = "SELECT id, name, testimonial, profile_picture FROM testimonials";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["testimonial"] . "</td>";
                    echo "<td><img src='../uploaded_images/" . $row["profile_picture"] . "' alt='Profile Picture' style='height: 50px;'></td>";
                    echo "<td><a href='delete-testimonial.php?id=" . $row["id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No testimonials found</td></tr>";
            }

           
            $conn->close();
            ?>
            </tbody>
        </table>
    </section>
</main>

<footer>
    <div class="footer-container">
        <div class="footer-nav">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="https://web.facebook.com/malcolmphotographer" target="_blank"><i class="ri-facebook-fill"></i></a>
                <a href="https://web.facebook.com/messages/t/280340858743797" target="_blank"><i class="ri-messenger-fill"></i></a>
                <a href="https://www.instagram.com/malcolm_photography/e" target="_blank"><i class="ri-instagram-fill"></i></a>
                <a href="https://www.linkedin.com/in/sashan-fernando-b91a71235/" target="_blank"><i class="ri-linkedin-fill"></i></a>
            </div>
        </div>
        <div class="footer-contact">
            <h4>Contact Details</h4>
            <p>Email: <a href="mailto:samithasashan2002@gmail.com">malcolmlismore@gmail.com</a></p>
            <p>Phone: <a href="tel:+94721362773">+44 1234 567890</a></p>
            <p>Address: 123 Photography Lane, North West Coast, Scotland</p>
        </div>
        <div class="footer-contact-form">
            <h4>Contact Us</h4>
            <form id="footer-contact-form">
                <input type="email" name="user_email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Malcolm Lismore Photography. All rights reserved.</p>
        <p>Designed by <a href="https://www.linkedin.com/in/sashan-fernando-b91a71235/" target="_blank">Sashan Fernando</a></p>
    </div>
</footer>
<script src="https://cdn.emailjs.com/dist/email.min.js"></script>
<script>
  (function() {
    emailjs.init("zRUyhECI3G-_bQHRf"); 
  })();

  document.getElementById('footer-contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    emailjs.sendForm('service_yrui98i', 'template_y6xaipk', this)
      .then(function(response) {
        alert('Message sent successfully!');
      }, function(error) {
        alert('Failed to send the message. Please try again.');
      });
  });
</script>

</body>
</html>
