 <!DOCTYPE html>
 <html lang="en">
 <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form</title>
        <script type="module" src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
 </head>
 <body>
        

<section class="w-full flex px-20 py-20 ">
   
    <form action="{{ route('form.create') }}" method="POST">
        @csrf
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" value="John"><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" value="Doe"><br><br>
        <input type="submit" value="Submit">
      </form>

</section>


 </body>
 </html>