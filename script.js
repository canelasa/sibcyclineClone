var users = [
    {
        name: 'Lucy',
        gender: 'F',
        hobby: 'pets',
        avatar: 'house1.jpg'
    },
    {
        name: 'Betty',
        gender: 'F',
        hobby: 'pets',
        avatar: 'house2.jpg'
    },
    {
        name: 'Ronald',
        gender: 'M',
        hobby: 'music',
        avatar: 'house3.jpg'
    },
    {
        name: 'Christopher',
        gender: 'M',
        hobby: 'sports',
        avatar: 'house4.jpg'
    },
    {
        name: 'Ximena',
        gender: 'F',
        hobby: 'reading',
        avatar: 'house5.jpg'
    },
    {
        name: 'Paul',
        gender: 'M',
        hobby: 'shopping',
        avatar: 'house6.jpg'
    },
    {
        name: 'Charlie',
        gender: 'M',
        hobby: 'pets',
        avatar: 'house7.jpg'
    },
];

// Add a handler to the load event for the window object
window.addEventListener('load', function() {


    var results = document.getElementById('results');

    function search() {

        //get hobby
        var hobbyField = document.getElementById('hobby');
        var hobby = hobbyField.value;


        //get gender
        var genderField = document.getElementById('gender');
        var s = genderField.selectedIndex;
        var gender = genderField.options[s].value;


        var resultsHtml = '';
        var usersLength = users.length;

		// Loop through each user
        for(var i = 0; i < usersLength; i++) {

			// If the user has the specified hobby
			if ((hobby == users[i].hobby ||
				 hobby==="") &&
				(gender == users[i].gender ||
				 gender==="A")) {

				resultsHtml += '<div class="person-row">\
								   <img src="images/' + users[i].avatar + '" />\
								   <div class="person-info">\
									   <div>' + users[i].name + '</div>\
									   <div>' + users[i].hobby + '</div>\
								   </div>\
									<button><a href="contact.html">Add as friend</a></button>\
								</div>';
			}
        }
        results.innerHTML = resultsHtml;
    }

    var searchBtn = document.getElementById('searchBtn');

    //searchBtn.addEventListener('click', search);
});
