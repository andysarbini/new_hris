/*
	return input select option
	obj = [
		{"id":"1","text":"Pramugari"},
		{"id":"2","text":"Waiter"},
		{"id":"3","text":"Koki"},
	];
	ex id = 2
	return (string)
		<option value="1">Pramugari</option>
		<option value="2" selected="selected">Waiter</option>
		<option value="3">Koki</option>

*/
function build_input_select(obj, id, att){
	var slc = "";
	$.each(obj, function(index, value){
		slc += "<option value='"+obj[index].id+"'";
		if(id != undefined) slc += "selected='selected' ";
		if(att != undefined) slc += " "+att+" ";
		slc += ">"+obj[index].text+"</option>";
	});
	return slc;
}

/*
	return value from structure obj
	obj = [
		{"id":"1","text":"Pramugari"},
		{"id":"2","text":"Waiter"},
		{"id":"3","text":"Koki"},
	];
	ex id = 2
	return Koki (string)

*/
function value_select(obj, id){
	var val = '';
	$.each(obj, function(index, value){
		if(value.id == id || value.id == id+'' ) val = value.text;
	});
	return val;
}
