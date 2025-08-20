import { BlogCardType } from '@/types/blogs'
import { Link } from '@inertiajs/react'
import React from 'react'

function BlogCard({blog}:{blog:BlogCardType}) {
  return (
    <Link href={`/blogs/${blog.slug}`} className='blog-card' >
        <img src={blog.thumbnail} className='blog-card-image'  />
        <div className="px-4">
        <h6 className='blog-card-title ' >{blog.title}</h6>
        <p className='body-4 text-neutral-10' dangerouslySetInnerHTML={{__html:blog.description}} ></p>
        {/* @ts-expect-error date is string */}
            <p className='caption-1 blog-card-caption' >{blog.created_at}</p>
        <div className="blog-card-tag-wrapper">
            <p className='caption-2 blog-card-tag' >استایل</p>
            <p className='caption-2 blog-card-tag' >انتخاب پارچه</p>
        </div>
        </div>
    </Link>
  )
}

export default BlogCard