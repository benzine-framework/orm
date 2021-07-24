<?php

namespace Benzine\ORM\Tests\Test\Models\Generated;

use Benzine\ORM\Tests\Test as App;
use Benzine\ORM\Tests\Models;
use Benzine\ORM\Tests\Models\UsersModel;
use Benzine\ORM\Tests\TableGateways;
use Benzine\ORM\Tests\TableGateways\UsersTableGateway;
use MatthewBaggett\UUID\UUID;
use Benzine\Tests\AbstractBaseTestCase;

/**
 * @covers \Benzine\ORM\Tests\Models\UsersModel
 * @covers \Benzine\ORM\Tests\Models\Base\BaseUsersAbstractModel
 * @covers \Benzine\ORM\Tests\TableGateways\UsersTableGateway
 * @covers \Benzine\ORM\Tests\TableGateways\Base\BaseUsersAbstractTableGateway
 *
 * @group generated
 * @group models
 * @internal
 */
class UsersTestAbstract extends AbstractBaseTestCase
{
    protected UsersModel $testInstance;
    protected UsersTableGateway$testTableGateway;

    /**
     * @before
     */
    public function setupDependencies(): void
    {
        $this->testTableGateway = App::DI(UsersTableGateway::class);
        $this->testInstance = $this->testTableGateway->getNewMockModelInstance();
    }

    public function testExchangeArray()
    {
        $data = [];
        $data['userId'] = self::getFaker()->randomDigitNotNull;
        $data['name'] = self::getFaker()->word;
        $data['email'] = self::getFaker()->word;
        $data['created'] = self::getFaker()->word;
        $this->testInstance = new UsersModel($data);
        $this->assertEquals($data['userId'], $this->testInstance->getUserId());
        $this->assertEquals($data['name'], $this->testInstance->getName());
        $this->assertEquals($data['email'], $this->testInstance->getEmail());
        $this->assertEquals($data['created'], $this->testInstance->getCreated());
    }

    public function testGetRandom()
    {
        // If there is no data in the table, create some.
        if (0 == $this->testTableGateway->getCount()) {
            $dummyObject = $this->testTableGateway->getNewMockModelInstance();
            $this->testTableGateway->save($dummyObject);
        }

        $user = $this->testTableGateway->fetchRandom();
        $this->assertTrue($user instanceof UsersModel, 'Make sure that "'.get_class($user).'" matches "UsersModel"');

        return $user;
    }

    public function testNewMockModelInstance()
    {
        $new = $this->testTableGateway->getNewMockModelInstance();

        $this->assertInstanceOf(
            Models\UsersModel::class,
            $new
        );

        $new->save();

        return $new;
    }

    public function testNewModelFactory()
    {
        $instance = UsersModel::factory();

        $this->assertInstanceOf(
            Models\UsersModel::class,
            $instance
        );
    }

    public function testSave()
    {
        /** @var Models\UsersModel $mockModel */
        /** @var Models\UsersModel $savedModel */
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
    public function testSettersAndGetters(UsersModel $users)
    {
        $this->assertTrue(method_exists($users, 'getuserId'));
        $this->assertTrue(method_exists($users, 'setuserId'));
        $this->assertTrue(method_exists($users, 'getname'));
        $this->assertTrue(method_exists($users, 'setname'));
        $this->assertTrue(method_exists($users, 'getemail'));
        $this->assertTrue(method_exists($users, 'setemail'));
        $this->assertTrue(method_exists($users, 'getcreated'));
        $this->assertTrue(method_exists($users, 'setcreated'));

        $testUsers = new UsersModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testUsers->setUserId($input);
        $this->assertEquals($input, $testUsers->getUserId());
        $input = self::getFaker()->word;
        $testUsers->setName($input);
        $this->assertEquals($input, $testUsers->getName());
        $input = self::getFaker()->word;
        $testUsers->setEmail($input);
        $this->assertEquals($input, $testUsers->getEmail());
        $input = self::getFaker()->word;
        $testUsers->setCreated($input);
        $this->assertEquals($input, $testUsers->getCreated());
    }

    public function testAutoincrementedIdIsApplied()
    {
        $new = $this->testTableGateway->getNewMockModelInstance();

        // Set primary keys to null.
        $new->setuserId(null);

        // Save the object
        $saved = $new->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($saved->getuserId());
        $this->assertGreaterThan(0, $saved->getuserId());
    }

    /**
     * @large
     */
    public function testDestroy()
    {
        /** @var Models\UsersModel $destroyableModel */
        $destroyableModel = $this->testTableGateway->getNewMockModelInstance();
        $destroyableModel->save();
        $this->assertTrue(true, $destroyableModel->destroy());
    }

    /**
     * @large
     */
    public function testdestroyRecursively()
    {
        /** @var Models\UsersModel $destroyableModel */
        $destroyableModel = $this->testTableGateway->getNewMockModelInstance();
        $destroyableModel->save();
        $this->assertGreaterThan(0, $destroyableModel->destroyRecursively());
    }

    /**
     * @depends testNewMockModelInstance
     */
    public function test_RemoteObjects_FetchBlogPostObjects(UsersModel $user)
    {
        // Verify the function exists
        $this->assertTrue(method_exists($user, "fetchBlogPostObjects"));

        /** @var TableGateways\BlogPostsTableGateway $tableGateway */
        $tableGateway = App::DI(TableGateways\BlogPostsTableGateway::class);

        $user->save();

        $this->assertNotNull($user->getUserId());

        /** @var Models\BlogPostsModel $newBlogPostsModel */
        $newBlogPostsModel = $tableGateway->getNewMockModelInstance();
        $newBlogPostsModel->setUserId($user->getUserId());

        // Save our new model. Make offerings to the gods of phpunit & transaction rollback to clean it up afterwards.
        $newBlogPostsModel->save();
        $this->assertNotNull($newBlogPostsModel->getUserId());

        // Call the singular function on it
        $blogPostsModel = $user->fetchBlogPostObject();

        $this->assertInstanceOf(Models\BlogPostsModel::class, $blogPostsModel);

        // Call the plural function on it
        $blogPostModels = $user->fetchBlogPostObjects();

        $this->assertGreaterThanOrEqual(1, count($blogPostModels), "fetchBlogPostObjects() failed to return atleast 1 Models\BlogPostsModel.");
        $this->assertContainsOnlyInstancesOf(Models\BlogPostsModel::class, $blogPostModels);

        return [$user, $blogPostModels];
    }

    /**
     * @depends test_RemoteObjects_FetchBlogPostObjects
     */
    public function test_RemoteObjects_CountBlogPostObjects($list)
    {
        /**
         * @var $user Models\UsersModel
         * @var $blogPostModels Models\BlogPostsModel[]
         */
        list($user, $blogPostModels) = $list;

        // Verify the function exists
        $this->assertTrue(method_exists($user, "countBlogPostObjects"));

        // Call the function on it
        $count = $user->countBlogPostObjects();

        $this->assertCount($count, $blogPostModels);
    }

    public function testGetPropertyMeta()
    {
        $propertyMeta = $this->testInstance->getPropertyMeta();
        $this->assertTrue(is_array($propertyMeta));
        $this->assertGreaterThan(0, count($propertyMeta));
        $this->assertArrayHasKey(UsersModel::FIELD_USERID, $propertyMeta);
        $this->assertArrayHasKey(UsersModel::FIELD_NAME, $propertyMeta);
        $this->assertArrayHasKey(UsersModel::FIELD_EMAIL, $propertyMeta);
        $this->assertArrayHasKey(UsersModel::FIELD_CREATED, $propertyMeta);
    }
}
