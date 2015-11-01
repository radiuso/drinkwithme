<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <script src="application/assets/libs/react/react.js"></script>
    <script src="application/assets/libs/react/react-dom.js"></script>
    <script src="application/assets/libs/babel/browser.js"></script>
    <script src="application/assets/libs/jquery/dist/jquery.js"></script>
</head>
<body>
    <div id="content"></div>
    <script type="text/babel">
        var Welcome = React.createClass({
            render: function() {
                return (
                    <div className="commentBox">
                        Hello, world! I am a CommentBox.
                        <div id="body">
                            <h2><a href="">REST Server Tests</a></h2>
                            <h2><a href={this.props.doc}>REST Server Documentation</a></h2>
                            <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

                            <p>If you would like to edit this page youll find it located at:</p>
                            <code>application/views/welcome_message.php</code>
                            <p>The corresponding controller for this page is found at:</p>
                            <code>application/controllers/Welcome.php</code>
                            <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="" target="_blank">User Guide</a>.</p>
                        </div>
                        <p className="footer">
                            Page rendered in <strong>{elapsed_time}</strong> seconds. </p>
                    </div>
                );
            }
        });
        ReactDOM.render(
          <Welcome doc="<?php echo base_url('documentation/index.html'); ?>" />,
          document.getElementById('content')
        );
    </script>
</body>
</html>
