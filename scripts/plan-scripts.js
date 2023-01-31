id = document.getElementById("planid").innerHTML.split(" ");
let dataTrain = new DataTrain(id[1]);

//add
document.querySelectorAll(".add").forEach(item => {
    item.addEventListener("click", event => {
        let id = event.target.value;
        let list = document.getElementById(id + "List");
        let content = document.getElementById(id).value
        document.getElementById(id).value = "";

        //put item into list for client to see
        let item = document.createElement("li");
        item.setAttribute('id', id + " " + content)
        item.appendChild(document.createTextNode(content));

        // let button = document.createElement("button");
        // button.setAttribute('class', "btn-danger align-self-end remove");
        // button.setAttribute('value', id + " " + content);
        // button.appendChild(document.createTextNode("Remove"));
        //
        // item.appendChild(button);

        list.appendChild(item);

        //store item to send to database later
        dataTrain.addClassNote(id, content);
    })
});

//delete
document.querySelectorAll(".remove").forEach(item => {
    item.addEventListener("click", event =>{
        let id = event.target.value;
        let item = document.getElementById(id);

        //remove item from list
        item.remove();

        //store item with quarter to send to database later
        dataTrain.addClassNote("deleted", id);
    })
});

document.querySelector(".save").addEventListener("click", event => {
    dataTrain.flush();
    document.querySelector(".save").classList.add("btn-success");
});