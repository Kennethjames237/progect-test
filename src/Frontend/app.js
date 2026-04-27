const API = "http://localhost:8081";

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("createBtn").addEventListener("click", createUser);
    document.getElementById("loadBtn").addEventListener("click", loadUsers);
});

function createUser() {
    const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    };

    fetch(`${API}/user`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
        alert("User created!");

        // ✅ CLEAR INPUTS AFTER SUCCESS
        document.getElementById("name").value = "";
        document.getElementById("email").value = "";
        document.getElementById("password").value = "";

        // optional: refresh list automatically
        loadUsers();
    })
    .catch(err => console.error(err));
}

function loadUsers() {
    fetch(`${API}/users`)
        .then(res => res.json())
        .then(data => {

            // 1. clear form inputs
            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";

            // 2. render users
            const container = document.getElementById("userList");
            container.innerHTML = "";

            const users = data.data;

            users.forEach(user => {
                const div = document.createElement("div");
                div.className = "user";

                div.innerHTML = `
                    <div>
                        <div class="name">${user.name}</div>
                        <div class="email">${user.email}</div>
                    </div>
                `;

                container.appendChild(div);
            });
        })
        .catch(err => console.error(err));
}