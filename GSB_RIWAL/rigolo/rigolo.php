<!DOCTYPE html>
<html>
<head>
  <style>
    @keyframes dvdAnimation {
      0%   { top: 0px; left: 0px; }
      25%  { top: calc(25% - 50px); left: calc(25% - 50px); }
      50%  { top: calc(50% - 50px); left: calc(50% - 50px); }
      75%  { top: calc(75% - 50px); left: calc(75% - 50px); }
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
