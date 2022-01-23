<!doctype html>
<html lang="ko">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI for Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/css/coreui.min.css" rel="stylesheet">

    <title>Hello, world!</title>
    <h1>Loop & Array</h1>
    <script>
      var coworkers = ['egoing','leezche','duru','taeho'];
    </script>
    <h2>Co workers</h2>
    <ul>
      <script>
        var i = 0;
        while(i < coworkers.length){
          document.write('<li><a href="http://a.com/'+coworkers[i]+'">'+coworkers[i]+'</a></li>');
          i = i + 1;
        }



      </script>
</ul>


Resources

  </head>
  <body>
    <h1>Hello, world!</h1>
    <input type="button" id="test" img src="/images/emptystar.png" style="width:25px; height:25px;">
    <input type="button" id="test2" img src="/images/emptystar.png" style="width:25px; height:25px;">
    

    @section('abc')
    <input type="text">abcd
    @endsection

@yield('abc')


    <button class="m-0 p-0" type="summit" style="background-color:transparent; border:transparent;"> <img src="/images/emptystar.png" id="rating1"
      style="width:25px; height:25px;"></button>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: CoreUI for Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/js/coreui.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and CoreUI for Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/js/coreui.min.js" integrity="sha384-SaOfVZfflYvITX2mrO/lzEHqlKsjF5PO3Jf+jowahmpQBKmO/fMoUypQcEMW0GJO" crossorigin="anonymous"></script>
    -->
  </body>

  <script>




let oneStar = document.getElementById('rating1');


let testId = document.getElementById('test');
let test2Id = document.getElementById('test2');  
    
function star_listener(event){
      switch(event.target.id){
        case 'test':
         alert(1);
         testId.setAttribute('src','/images/star.png'); 
        break;

        case 'test2':
        alert(2);
        break;
    }
  }
    testId.addEventListener('click', star_listener);
    test2Id.addEventListener('click', star_listener);


    const myArr = [1, 2, 3, 4, 5];

const newMyArr = myArr.forEach((currentElement, index, array) => {
    console.log(`요소: ${currentElement}`);
    console.log(`index: ${index}`);
    console.log(array);
});

console.log(newMyArr); // undefined


    
    </script>


</html>