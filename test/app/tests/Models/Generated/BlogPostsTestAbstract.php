<?php

namespace Benzine\ORM\Tests\Test\Models\Generated;

use Benzine\ORM\Tests\Test as App;
use Benzine\ORM\Tests\Models;
use Benzine\ORM\Tests\Models\BlogPostsModel;
use Benzine\ORM\Tests\TableGateways;
use Benzine\ORM\Tests\TableGateways\BlogPostsTableGateway;
use MatthewBaggett\UUID\UUID;
use Benzine\Tests\AbstractBaseTestCase;

/**
 * @covers \Benzine\ORM\Tests\Models\BlogPostsModel
 * @covers \Benzine\ORM\Tests\Models\Base\BaseBlogPostsAbstractModel
 * @covers \Benzine\ORM\Tests\TableGateways\BlogPostsTableGateway
 * @covers \Benzine\ORM\Tests\TableGateways\Base\BaseBlogPostsAbstractTableGateway
 *
 * @group generated
 * @group models
 * @internal
 */
class BlogPostsTestAbstract extends AbstractBaseTestCase
{
    protected BlogPostsModel $testInstance;
    protected BlogPostsTableGateway$testTableGateway;

    /**
     * @before
     */
    public function setupDependencies(): void
    {
        $this->testTableGateway = App::DI(BlogPostsTableGateway::class);
        $this->testInstance = $this->testTableGateway->getNewMockModelInstance();
    }

    public function testExchangeArray()
    {
        $data = [];
        $data['blogPostId'] = self::getFaker()->randomDigitNotNull;
        $data['title'] = self::getFaker()->word;
        $data['description'] = self::getFaker()->word;
        $data['userId'] = self::getFaker()->randomDigitNotNull;
        $data['created'] = self::getFaker()->word;
        $this->testInstance = new BlogPostsModel($data);
        $this->assertEquals($data['blogPostId'], $this->testInstance->getBlogPostId());
        $this->assertEquals($data['title'], $this->testInstance->getTitle());
        $this->assertEquals($data['description'], $this->testInstance->getDescription());
        $this->assertEquals($data['userId'], $this->testInstance->getUserId());
        $this->assertEquals($data['created'], $this->testInstance->getCreated());
    }

    public function testGetRandom()
    {
        // If there is no data in the table, create some.
        if (0 == $this->testTableGateway->getCount()) {
            $dummyObject = $this->testTableGateway->getNewMockModelInstance();
            $this->testTableGateway->save($dummyObject);
        }

        $blogPost = $this->testTableGateway->fetchRandom();
        $this->assertTrue($blogPost instanceof BlogPostsModel, 'Make sure that "'.get_class($blogPost).'" matches "BlogPostsModel"');

        return $blogPost;
    }

    public function testNewMockModelInstance()
    {
        $new = $this->testTableGateway->getNewMockModelInstance();

        $this->assertInstanceOf(
            Models\BlogPostsModel::class,
            $new
        );

        $new->save();

        return $new;
    }

    public function testNewModelFactory()
    {
        $instance = BlogPostsModel::factory();

        $this->assertInstanceOf(
            Models\BlogPostsModel::class,
            $instance
        );
    }

    public function testSave()
    {
        /** @var Models\BlogPostsModel $mockModel */
        /** @var Models\BlogPostsModel $savedModel */
        $mockModel = $this->testTableGateway->getNewMockModelInstance();
        $savedModel = $mockModel->save();

        $mockModelArray = $mockModel->__toArray();
        $savedModelArray = $savedModel->__toArray();

        // Remove auto increments from test.
        foreach ($mockModel->getAutoIncrementKeys() as $autoIncrementKey => $discard) {
            foreach ($mockModelArray as $key => $value) {
                if (strtolower($key) == strtolower($autoIncrementKey)) {
                    unset($mockModelArray[$key], $savedModelArray[$key]);
                }
            }
        }
        // Remove non-literal fields from comparison - these will be autogenerated by the server and is outside the scope of this test.
        unset($mockModelArray['Created'], $savedModelArray['Created']);

        $this->assertEquals($mockModelArray, $savedModelArray);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(BlogPostsModel $blogPosts)
    {
        $this->assertTrue(method_exists($blogPosts, 'getblogPostId'));
        $this->assertTrue(method_exists($blogPosts, 'setblogPostId'));
        $this->assertTrue(method_exists($blogPosts, 'gettitle'));
        $this->assertTrue(method_exists($blogPosts, 'settitle'));
        $this->assertTrue(method_exists($blogPosts, 'getdescription'));
        $this->assertTrue(method_exists($blogPosts, 'setdescription'));
        $this->assertTrue(method_exists($blogPosts, 'getuserId'));
        $this->assertTrue(method_exists($blogPosts, 'setuserId'));
        $this->assertTrue(method_exists($blogPosts, 'getcreated'));
        $this->assertTrue(method_exists($blogPosts, 'setcreated'));

        $testBlogPosts = new BlogPostsModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testBlogPosts->setBlogPostId($input);
        $this->assertEquals($input, $testBlogPosts->getBlogPostId());
        $input = self::getFaker()->word;
        $testBlogPosts->setTitle($input);
        $this->assertEquals($input, $testBlogPosts->getTitle());
        $input = self::getFaker()->word;
        $testBlogPosts->setDescription($input);
        $this->assertEquals($input, $testBlogPosts->getDescription());
        $input = self::getFaker()->randomDigitNotNull;
        $testBlogPosts->setUserId($input);
        $this->assertEquals($input, $testBlogPosts->getUserId());
        $input = self::getFaker()->word;
        $testBlogPosts->setCreated($input);
        $this->assertEquals($input, $testBlogPosts->getCreated());
    }

    public function testAutoincrementedIdIsApplied()
    {
        $new = $this->testTableGateway->getNewMockModelInstance();

        // Set primary keys to null.
        $new->setblogPostId(null);

        // Save the object
        $saved = $new->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($saved->getblogPostId());
        $this->assertGreaterThan(0, $saved->getblogPostId());
    }

    /**
     * @large
     */
    public function testDestroy()
    {
        /** @var Models\BlogPostsModel $destroyableModel */
        $destroyableModel = $this->testTableGateway->getNewMockModelInstance();
        $destroyableModel->save();
        $this->assertTrue(true, $destroyableModel->destroy());
    }

    /**
     * @large
     */
    public function testdestroyRecursively()
    {
        /** @var Models\BlogPostsModel $destroyableModel */
        $destroyableModel = $this->testTableGateway->getNewMockModelInstance();
        $destroyableModel->save();
        $this->assertGreaterThan(0, $destroyableModel->destroyRecursively());
    }


    /**
     * @depends testNewMockModelInstance
     */
    public function test_RelatedObjects_FetchUserObject(BlogPostsModel $blogPost)
    {
        // Verify the function exists
        $this->assertTrue(method_exists($blogPost, "fetchUserObject"));

        // Call the function on it
        $blogPostModel = $blogPost->fetchUserObject();

        $this->assertInstanceOf(Models\UsersModel::class, $blogPostModel);
    }

    public function testGetPropertyMeta()
    {
        $propertyMeta = $this->testInstance->getPropertyMeta();
        $this->assertTrue(is_array($propertyMeta));
        $this->assertGreaterThan(0, count($propertyMeta));
        $this->assertArrayHasKey(BlogPostsModel::FIELD_BLOGPOSTID, $propertyMeta);
        $this->assertArrayHasKey(BlogPostsModel::FIELD_TITLE, $propertyMeta);
        $this->assertArrayHasKey(BlogPostsModel::FIELD_DESCRIPTION, $propertyMeta);
        $this->assertArrayHasKey(BlogPostsModel::FIELD_USERID, $propertyMeta);
        $this->assertArrayHasKey(BlogPostsModel::FIELD_CREATED, $propertyMeta);
    }
}
