

<script>

	person = new Object();
	person.name = 'Ivan';
	person.age = 38;

	person.run = function(dist){

		return this.name + " ran " + dist + "km. today!";
	}

	alert(person.run(3));
</script>