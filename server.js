const app = require("express")();
const http = require("http").Server(app);
const io = require("socket.io")(http, {
    cors: {
        origin: "http://localhost",
        methods: ["GET", "POST"]
    }
});
// const cors = require("cors");
// app.use(cors());

io.on("connection", (socket) => {
    console.log("A user connected");

    // Listen events from client side
    socket.on("editRankValueEvent", (data) => {
        // console.log("Received Edit Value Event: ", data);

        // emit "afterEditRankValueEvent" back to the client side
        io.sockets.emit("afterEditRankValueEvent", { message: "Response from server" });
    });

    socket.on("disconnect", () => {
        console.log("A user disconnected");
    });
});

http.listen(3000, () => {
    console.log("Socket.IO server listening on port 3000");
});
