document.getElementById('addbetchbtn').addEventListener('click', () => {

    document.getElementById('students-data').style.display = 'block';

    document.getElementById('addbetchbtn').style.display = 'none';

    document.getElementById('submit').style.display= 'none';

});



let i = 0;

let rollOptions = '';

for (let j = 1; j <= 45; j++) {

    rollOptions += `<option value="CPE-${j}">CPE-${j}</option>`;

}



document.getElementById('add-student-btn').addEventListener('click', () => {

    document.getElementById('submit').style.display= 'inline-block';

    if (i >= 45) {

        alert('You can add a maximum of 45 students in one session');

        document.getElementById('add-student-btn').disabled = true;

        return;

    }

    i++;

    const studentDiv = document.createElement('div');

    studentDiv.classList.add('inputFields');

    studentDiv.innerHTML = `

        <div class="data">

            <input type="text" name="name[]" placeholder="Enter Name" required>

        </div>

        <div class="data">

            <input type="text" name="father_name[]" placeholder="Enter father name" required>

        </div>

        <div class="data">

            <select name="roll_no[]" class="select" required>

                <option selected disabled value="">Roll No...</option>

                ${rollOptions}

            </select>

        </div>

        <div class="data">

            <input type="email" name="email[]" placeholder="Enter email" required>

        </div>

        <div class="data">

            <input type="text"  name="id_card[]" id="id_card" maxlength="13" title="Enter 13 digit ID Card number"  placeholder="13 Digit ID CARD Or form B" required>

        </div>

        <div class="data">

            <input type="date" name="dob[]" required>

        </div>

        <div class="data">

            <select name="gender[]" class="select" required>

                <option selected disabled>Gender...</option>

                <option value="male">Male</option>

                <option value="female">Female</option>

                <option value="other">Other</option>

            </select>

        </div>`;

    document.getElementById('students').appendChild(studentDiv);

});
