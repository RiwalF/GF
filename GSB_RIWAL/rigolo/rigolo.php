<!DOCTYPE html>
<html>
<head>
  <style>
    @keyframes dvdAnimation {
      0%   { top: 0px; left: 0px; }
      25%  { top: 0px; left: 100%; }
      50%  { top: 100%; left: 100%; }
      75%  { top: 100%; left: 0px; }
      100% { top: 0px; left: 0px; }
    }
    
    #dvdLogo {
      position: absolute;
      width: 100px;
      height: 100px;
      animation: dvdAnimation 4s infinite;
    }
  </style>
</head>
<body>
  <div id="dvdLogo">
    <img src="val.jpg" alt="DVD Logo">
  </div>
</body>
</html>
