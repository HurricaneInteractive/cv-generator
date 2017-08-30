import React from 'react';

export const Layout = (props) => {
    return (
        <div className="process">
            <div className="process--header">
                <h1>Create new Resume</h1>
                <h2>Choose a Layout</h2>
            </div>
            <div className="process--layout">
                <ul>
                    <li>
                        <img />
                        <h3>Offset Sidebar</h3>
                        <p>Professional looking layout suitable for corporate positions.</p>
                        <a href="#" className="btn layout-select">Start Creating</a>
                    </li>
                    <li>
                        <img />
                        <h3>2 Columns</h3>
                        <p>Professional looking layout suitable for corporate positions.</p>
                        <a href="#" className="btn layout-select">Start Creating</a>
                    </li>
                    <li>
                        <img />
                        <h3>Content Focused</h3>
                        <p>Professional looking layout suitable for corporate positions.</p>
                        <a href="#" className="btn layout-select">Start Creating</a>
                    </li>
                </ul>
            </div>
        </div>
    )
}