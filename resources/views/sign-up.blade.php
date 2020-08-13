<html>
<head>
    <title>Sign Up</title>
</head>

<body>
    <header>
        <h1>Buat Account Baru!</h1>
        <h3>Sign Up Form</h3>
    </header>

    <form action="/welcome" method="POST">
        @csrf

        <h4>Firstname: </h4>
            <input placeholder="Firstname" name="firstname" id="firstname"/>
        <h4>Lastname: </h4>
            <input placeholder="Lastname" name="lastname" id="lastname"/>
        <h4>Gender: </h4>
            <label><input type="radio" name="gender" id="male">Male</label> 
            <br>
            <label><input type="radio" name="gender" id="female">Female</label> 
            <br>
            <label><input type="radio" name="gender" id="other">Other</label>
        <h4>
            Nationality: 
            <select>
                <option>Indonesia</option>
                <option>Vietnam</option>
                <option>Israel</option>
                <option>Russia</option>
                <option>Germany</option>
            </select>
        </h4>
        <h4>Language Spoken: </h4>
            <label><input type="checkbox">Bahasa Indonesia</label> 
            <br>
            <label><input type="checkbox">English</label> 
            <br>
            <label><input type="checkbox">Other</label>
        <h4>Bio: </h4>
        <textarea rows="8" cols="35"></textarea>
        <p>
            <input type="submit" value="SignUp"/>
        </p>

    </form>

</body>
</html>