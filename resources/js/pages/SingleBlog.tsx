import Breadcrumb from '@/components/modules/breadcrumb/Breadcrumb'
import Container from '@/components/modules/container/Container'
import BlogCommentForm from '@/components/templates/blogs/BlogCommentForm'
import BlogComments from '@/components/templates/blogs/BlogComments'
import SingleBlogSideBar from '@/components/templates/blogs/SingleBlogSideBar'
import {BlogType } from '@/types/blogs'
import { usePage } from '@inertiajs/react'


function SingleBlogPage() {
  const data=usePage() as {props:{blog:{data:BlogType}}}
      const {blog}=data.props
      console.log(data.props);
  return (
    <>
    <Breadcrumb/>
    <Container className='my-5' >
        <div className="col-span-8 max-tablet:col-span-12">
        <h1 className='text-neutral-12 max-tablet:!text-[20px] mb-6 '>{blog.title}</h1>
        <img src={blog.thumbnail} alt="" className='blog-main-image' />
        <div className="blog-content" dangerouslySetInnerHTML={{__html:blog.content}}></div>
        </div>
        <div className="col-span-4 max-tablet:col-span-12 max-tablet:mt-4 tablet:py-10">
            <SingleBlogSideBar/>
        </div>
    <BlogComments/>
    <BlogCommentForm/>
    </Container>

    </>
  )
}

export default SingleBlogPage