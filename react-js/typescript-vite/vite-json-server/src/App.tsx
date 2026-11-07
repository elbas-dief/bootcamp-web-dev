import { useEffect, useState } from "react";
import "./App.css";

export interface Post {
    id: string;
    title: string;
    views: number;
    name: string;
    imageUrl: string;
}

function App() {
    // 1. BIKIN STATE untuk PENAMPUNG
    const [posts, setPosts] = useState<Post[]>([]);
    // [INIT VALUE nilai awal, SET VALUE update nilai postnya]
    // ([]) => Isi nilai INIT VALUE
    // Post[] => Array of Object dari Post
    // const [loading, setLoading] = useState<boolean>(true);

    // 2. BIKIN FUNCTION FETCHING (ambil data)
    const fetchPosts = async (): Promise<Post[]> => {
        const response = await fetch("http://localhost:3000/posts");

        if (!response.ok) {
            throw new Error('HTTP error! Status: ${response.status}');
        }

        const data: Post[] = await response.json();

        return data;
    };

    // 3. RENDER pertama kali di muat (USEEFFECT)
    useEffect(() => {
        const loadPosts = async () => {
            try {
                const data = await fetchPosts();
                setPosts(data);
            } catch (error) {
                console.log(error);
            }
        };

        loadPosts();
    }, []);

    console.log(posts);

    return (
        <>
            <h1 className="text-lime-500 ml-50">Hello From VITE Sosmed Apps</h1>
            <div className="p-5">
                {posts.map((post) => (
                    <div key={post.id} className="border-2 rounded-2xl p-4 shadow-sm transition hover:shadow-md mt-2">
                        <img src={post.imageUrl} style={{ width: "40px", borderRadius: "50%" }} alt="" />
                        {/* <p className="font-semibold text-gray-800">Id: User {post.id}</p> */}
                        <p className="font-semibold text-gray-800">Name: {post.name}</p>
                        <p className="text-gray-600">Content: {post.title}</p>
                        <p className="text-sm text-gray-400">Views: {post.views}</p>
                    </div>
                ))}
            </div>
        </>
    );
}

export default App;