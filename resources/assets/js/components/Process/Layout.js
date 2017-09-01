import React from 'react';

export const Layout = (props) => {

    const LayoutOptions = [
        {
            'image': '/images/offset-sidebar.svg',
            'title': 'Offset Sidebar',
            'description': 'Professional looking layout suitable for corporate positions.',
            'layout_id': 'offset-sidbar'
        },
        {
            'image': '/images/two-columns.svg',
            'title': '2 Columns',
            'description': 'Professional looking layout suitable for corporate positions.',
            'layout_id': 'two-columns'
        },
        {
            'image': '/images/content-focused.svg',
            'title': 'Content Focused',
            'description': 'Professional looking layout suitable for corporate positions.',
            'layout_id': 'content-focused'
        }
    ];

    const submitLayoutChoice = (inc, layout) => {
        props.changeStep(inc);
        props.chooseLayout(layout);
    }

    const renderLayoutOptions = () => {
        return LayoutOptions.map((layout, index) => {
            return (
                <li className={ props.currentLayout === layout.layout_id ? 'active' : '' } key={index} onClick={() => { submitLayoutChoice(1, layout.layout_id) }}>
                    <img src={layout.image} />
                    <h3>{layout.title}</h3>
                    <p>{layout.description}</p>
                    <a href="#" className="btn layout-select">Start Creating</a>
                    <div className="example-option">
                        <span>or</span>
                        <a href="#">View example Resume</a>
                    </div>
                </li>
            )
        });
    }

    return (
        <div className="process">
            <div className="process--header">
                <h1>Create new Resume</h1>
                <h2>Choose a Layout</h2>
            </div>
            <div className="process--layout">
                <ul>
                    { renderLayoutOptions() }
                </ul>
            </div>
        </div>
    )
}