import React from "react"

const Sidebar = props => {
    return <div className="student-sidebar">
            <ul className="pt-md-5">
                <li className="active">
                    <a href="" className="text-white p-4 d-inline-block"><i className="fas fa-th-large"></i></a>
                </li>
                <li className="opacity-50">
                    <a href="" className="text-white p-4 d-inline-block"><i class="fas fa-signal"></i></a>
                </li>
                <li className="opacity-50">
                    <a href="" className="text-white p-4 d-inline-block"><i class="fas fa-calendar"></i></a>
                </li>
                <li className="opacity-50">
                    <a href="" className="text-white p-4 d-inline-block"><i className="fas fa-cog"></i></a>
                </li>
            </ul>
        </div>;
}

export default Sidebar;